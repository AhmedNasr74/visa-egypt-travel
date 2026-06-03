<?php

namespace App\Http\Controllers\Site;

use App\Enums\SettingKey;
use App\Http\Controllers\Controller;
use App\Mail\ContactFormMail;
use App\Mail\AppointmentMail;
use App\Models\Appointment;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Country;
use App\Models\Destination;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Tour;
use App\Support\SiteSeo;
use Illuminate\Http\Request;
use App\Services\DualEmailSender;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    /**
     * @throws \Throwable
     */
    public function index(Request $request)
    {

        $packages = Tour::whereHas('categories', function ($query) {
            $query->whereId(setting(SettingKey::HOME_FIRST_SECTION_TOURS->value, true));
        })->orderByRaw('ISNULL(order_id), order_id')->where('enabled', true)->where('featured', true)->limit(6)->get();
        
        $offers = Tour::whereHas('categories', function ($query) {
            $query->whereId(setting(SettingKey::HOME_SECOND_SECTION_TOURS->value, true));
        })->orderByRaw('ISNULL(order_id), order_id')->where('enabled', true)->where('featured', true)->limit(6)->get();
        
        $settings = Setting::all();
        $slider = $settings->firstWhere('option_key', \App\Enums\SettingKey::MAIN_HOME_SLIDER->value)?->option_value ?? [];

        $destinations = Destination::limit(5)->get();
        $categories = Category::where('enabled', true)->get();
        $countries = Country::select("name", "flag")->get();
        $blogs = Blog::orderBy('id', 'desc')->get();
        $page = Page::byKey('home')->with('seo')->first();
        if ($page) {
            $page->publish();
        } else {
            SiteSeo::publishPage(
                SiteSeo::siteName(),
                SiteSeo::siteDescription(),
                SiteSeo::defaultImage()
            );
        }

        $page = $page ?? Page::byKey('home')->firstOrNew();

        $homeFaqs = Faq::where('enabled', true)
            ->where(function ($query) {
                $query->where('home', true)->orWhere('important', true);
            })
            ->orderByDesc('important')
            ->orderByDesc('home')
            ->limit(8)
            ->get();

        return view('site.home.index', compact(
            'page',
            'packages',
            'offers',
            'slider',
            'blogs',
            'destinations',
            'categories',
            'countries',
            'homeFaqs',
        ));
    }

    public function makeAppointment(Request $request)
    {
        try {
            // Debug: Log the incoming request data
            \Log::info('Appointment form data received:', $request->all());
            
            // Determine if this is a Nile Cruise appointment based on cruise-specific fields
            $isNileCruise = $request->has('cruise_type') || $request->has('cruise_pick_drop_off') || $request->has('cruise_duration');
            $formType = $isNileCruise ? 'nile_cruise' : 'appointment';
            
            \Log::info('Form type detected:', ['form_type' => $formType, 'is_nile_cruise' => $isNileCruise]);
            
            $validator = Validator::make($request->all(), [
                'nickname' => ['required', 'string'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'phone' => ['required', 'string', 'max:255'],
                'adults' => ['required', 'integer', 'min:1'],
                'children' => ['required', 'integer', 'min:0'],
                'arrival_date' => ['required', 'date', 'after_or_equal:today'],
                'departure_date' => ['required', 'date'],
                'notes' => ['nullable', 'string'],
                'nationality' => ['required'],
                'hotel_choice' => ['required'],
                'age_range' => ['required'],
                'hear_about_us' => ['required'],
                // Nile Cruise specific fields
                'cruise_type' => ['nullable', 'array'],
                'cruise_type.*' => ['nullable', 'string'],
                'cruise_pick_drop_off' => ['nullable', 'array'],
                'cruise_pick_drop_off.*' => ['nullable', 'string'],
                'cruise_duration' => ['nullable', 'array'],
                'cruise_duration.*' => ['nullable', 'string'],
            ]);

            if ($validator->fails()) {
                \Log::error('Appointment form validation failed:', $validator->errors()->toArray());
                return response()->json([
                    'message' => $validator->errors()->first()
                ], 422);
            }
            
            $data = $validator->validated();

            // Empty optional notes become null via middleware; DB column is NOT NULL.
            $data['notes'] = trim((string) ($data['notes'] ?? ''));

            // Process array fields for Nile Cruise
            if ($isNileCruise) {
                $data['cruise_type'] = is_array($data['cruise_type']) ? implode(', ', array_filter($data['cruise_type'])) : $data['cruise_type'];
                $data['cruise_pick_drop_off'] = is_array($data['cruise_pick_drop_off']) ? implode(', ', array_filter($data['cruise_pick_drop_off'])) : $data['cruise_pick_drop_off'];
                $data['cruise_duration'] = is_array($data['cruise_duration']) ? implode(', ', array_filter($data['cruise_duration'])) : $data['cruise_duration'];
            }
            
            \Log::info('Appointment form validated data:', $data);
            
            $appointment = Appointment::create($data);
            \Log::info('Appointment record created successfully:', ['id' => $appointment->id, 'form_type' => $formType]);
            
            DualEmailSender::sendGuest(
                $data['email'],
                new AppointmentMail($data, false, $formType),
                'appointment_form',
                ['appointment_id' => $appointment->id, 'form_type' => $formType]
            );

            DualEmailSender::sendAdmin(
                new AppointmentMail($data, true, $formType),
                'appointment_form',
                ['appointment_id' => $appointment->id, 'form_type' => $formType]
            );

            $successMessage = $isNileCruise 
                ? 'Your Nile River Cruise request has been submitted successfully! We will contact you soon.'
                : __('main.appointment-sent-message');
            
            return response()->json([
                'message' => $successMessage,
                'appointment_id' => $appointment->id,
                'form_type' => $formType
            ]);
        } catch (\Exception $exception) {
            \Log::error('Appointment form submission error: ' . $exception->getMessage());
            \Log::error('Stack trace: ' . $exception->getTraceAsString());
            report($exception);
            return response()->json([
                'error' => config('app.debug')
                    ? $exception->getMessage()
                    : __('main.unexpected-error'),
            ], 500);
        }
    }

    public function filterFeaturedTours(Request $request)
    {
        $filter_category = $request->category;

        $filtration_query = Tour::orderByRaw('ISNULL(order_id), order_id')->limit(16);

        if ($filter_category != 'all') {
            $filtration_query->whereHas('categories', function ($query) use ($filter_category) {
                $query->whereId($filter_category);
            });
        }

        $day_tours = $filtration_query->get();

        return view('site.home.sections.tour-boxes', compact('day_tours'))->render();
    }

    public function call(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'numeric'],
        ]);
        DualEmailSender::sendAdmin(
            new ContactFormMail($data),
            'callback_request',
            ['phone' => $data['phone'] ?? null]
        );

        return response()->json(['message' => 'Email Sent We Will Call U Soon !']);
    }
}
