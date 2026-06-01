<!-- Page Sidebar Start-->
<div class="page-sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper">
            <a href="{{ route('dashboard') }}">
                <img class="d-none d-lg-block blur-up lazyloaded sidebar-logo" src="{{ logo() }}" alt="">
            </a>
        </div>
    </div>
    <div class="sidebar custom-scrollbar">
        <a href="javascript:void(0)" class="sidebar-back d-lg-none d-block">
            <i class="fa fa-times" aria-hidden="true"></i>
        </a>
        <div class="sidebar-user">
            <img class="img-60" src="{{ logo() }}" alt="#">
            <div>
                <h6 class="f-14">{{ admin()->first_name }}</h6>
                <p>{{ admin()->role }}</p>
            </div>
        </div>
        <ul class="sidebar-menu">
            <x-dashboard.sidebar.single-link title="Dashboard" link="{{ route('dashboard') }}" icon="home" />

            <x-dashboard.sidebar.single-link title="Media" class="open-media" link="javascript:;" icon="camera" />

            <x-dashboard.sidebar.link-with-child title="Users" icon="user" :permissions="['users.list', 'users.create', 'users.edit', 'users.delete']" :children="[
                [
                    'title' => 'Users',
                    'link' => route('dashboard.users.index'),
                    'permissions' => ['users.list', 'users.edit', 'users.delete'],
                ],
                [
                    'title' => 'Create User',
                    'link' => route('dashboard.users.create'),
                    'permissions' => ['users.create'],
                ],
            ]" />

            <x-dashboard.sidebar.link-with-child title="Roles" icon="users" :permissions="['roles.list', 'roles.create', 'roles.edit', 'roles.delete']" :children="[
                [
                    'title' => 'Roles',
                    'link' => route('dashboard.roles.index'),
                    'permissions' => ['roles.list', 'roles.edit', 'roles.delete'],
                ],
                [
                    'title' => 'Create Role',
                    'link' => route('dashboard.roles.create'),
                    'permissions' => ['roles.create'],
                ],
            ]" />
              <x-dashboard.sidebar.link-with-child title="Pages" icon="book-open" :permissions="[ 'pages.list', 'pages.create', 'pages.edit', 'pages.delete']"
              :children="[
                  [
                      'title' => 'Create Page',
                      'link' => route('dashboard.pages.create'),
                      'permissions' => ['pages.create'],
                  ],
                  [
                      'title' => 'Pages',
                      'link' => route('dashboard.pages.index'),
                      'permissions' => ['pages.list', 'pages.create','pages.edit', 'pages.delete'],
                  ],
              ]"
          />

                        <x-dashboard.sidebar.link-with-child title="Currencies" icon="dollar-sign" :permissions="['currencies.list', 'currencies.create', 'currencies.edit', 'currencies.delete']"
                        :children="[
                            [
                                'title' => 'Currencies',
                                'link' => route('dashboard.currencies.index'),
                                'permissions' => ['currencies.list', 'currencies.edit', 'currencies.delete'],
                            ],
                            [
                                'title' => 'Create Currency',
                                'link' => route('dashboard.currencies.create'),
                                'permissions' => ['currencies.create'],
                            ],
                        ]" />
            <x-dashboard.sidebar.link-with-child title="Customized Trip" icon="grid" :permissions="['customized-categories.list', 'customized-categories.create', 'customized-categories.edit', 'customized-categories.delete', 'customized-categories.restore','customized-trips.list', 'customized-trips.create', 'customized-trips.edit', 'customized-trips.delete', 'customized-trips.restore']"
            :children="[
                [
                    'title' => 'Destinations',
                    'link' => route('dashboard.customized-categories.index'),
                    'permissions' => ['customized-categories.list','customized-categories.create', 'customized-categories.edit', 'customized-categories.delete'],
                ],
                [
                    'title' => 'All Customized Trips',
                    'link' => route('dashboard.customized-trips.index'),
                    'permissions' => ['customized-trips.list', 'customized-trips.create', 'customized-trips.edit', 'customized-trips.delete', 'customized-trips.restore'],
                ],

            ]" />


            <x-dashboard.sidebar.link-with-child title="comments" icon="user-check" :permissions="['comments.list', 'comments.create', 'comments.edit', 'comments.delete']"
                :children="[
                    [
                        'title' => 'comments',
                        'link' => route('dashboard.comments.index'),
                        'permissions' => ['comments.list', 'comments.edit', 'comments.delete'],
                    ],
                    [
                        'title' => 'Create Comment',
                        'link' => route('dashboard.comments.create'),
                        'permissions' => ['comments.create'],
                    ],
                ]" />
                <x-dashboard.sidebar.link-with-child title="Clients" icon="user-check" :permissions="['clients.list', 'clients.create', 'clients.edit', 'clients.delete']"
                :children="[
                    [
                        'title' => 'Clients',
                        'link' => route('dashboard.clients.index'),
                        'permissions' => ['clients.list', 'clients.edit', 'clients.delete'],
                    ],
                    [
                        'title' => 'Create Client',
                        'link' => route('dashboard.clients.create'),
                        'permissions' => ['clients.create'],
                    ],
                ]" />
                    <x-dashboard.sidebar.link-with-child title="Employee" icon="user-check" :permissions="['employees.list', 'employees.create', 'employees.edit', 'employees.delete', 'employees.restore']"
                    :children="[
                        [
                            'title' => 'Employee',
                            'link' => route('dashboard.employees.index'),
                            'permissions' => ['employees.list', 'employees.edit', 'employees.delete'],
                        ],
                        [
                            'title' => 'Create Employee',
                            'link' => route('dashboard.employees.create'),
                            'permissions' => ['employees.create'],
                        ],
                    ]" />
            <x-dashboard.sidebar.link-with-child title="Coupons" icon="tag" :permissions="['coupons.list', 'coupons.create', 'coupons.edit', 'coupons.delete']" :children="[
                [
                    'title' => 'Coupons',
                    'link' => route('dashboard.coupons.index'),
                    'permissions' => ['coupons.list', 'coupons.edit', 'coupons.delete'],
                ],
                [
                    'title' => 'Create Coupon',
                    'link' => route('dashboard.coupons.create'),
                    'permissions' => ['coupons.create'],
                ],
            ]" />

            <x-dashboard.sidebar.link-with-child title="Destinations" icon="globe" :permissions="['destinations.list', 'destinations.create', 'destinations.edit', 'destinations.delete']"
                :children="[
                    [
                        'title' => 'Destinations',
                        'link' => route('dashboard.destinations.index'),
                        'permissions' => ['destinations.list', 'destinations.edit', 'destinations.delete'],
                    ],
                    [
                        'title' => 'Create Destination',
                        'link' => route('dashboard.destinations.create'),
                        'permissions' => ['destinations.create'],
                    ],
                ]" />

            <x-dashboard.sidebar.link-with-child title="Locations" icon="map-pin" :permissions="['locations.list', 'locations.create', 'locations.edit', 'locations.delete', 'locations.restore']"
                :children="[
                    [
                        'title' => 'Locations',
                        'link' => route('dashboard.locations.index'),
                        'permissions' => ['locations.list', 'locations.edit', 'locations.delete', 'locations.restore'],
                    ],
                    [
                        'title' => 'Create Location',
                        'link' => route('dashboard.locations.create'),
                        'permissions' => ['locations.create'],
                    ],
                ]" />

            <x-dashboard.sidebar.link-with-child title="Car Routes" icon="navigation" :permissions="['car-routes.list', 'car-routes.create', 'car-routes.edit', 'car-routes.delete', 'car-routes.restore', 'car-routes.import']"
                :children="[
                    [
                        'title' => 'Car Routes',
                        'link' => route('dashboard.car-routes.index'),
                        'permissions' => ['car-routes.list', 'car-routes.edit', 'car-routes.delete', 'car-routes.restore', 'car-routes.import'],
                    ],
                    [
                        'title' => 'Create Car Route',
                        'link' => route('dashboard.car-routes.create'),
                        'permissions' => ['car-routes.create'],
                    ],
                ]" />

            <x-dashboard.sidebar.single-link :permissions="['car-rentals.list', 'car-rentals.show']" title="Car Rentals" link="{{ route('dashboard.car-rentals.index') }}" icon="truck" />

            <x-dashboard.sidebar.link-with-child title="Categories" icon="book-open" :permissions="['categories.list', 'categories.create', 'categories.edit', 'categories.delete']"
                :children="[
                    [
                        'title' => 'Categories',
                        'link' => route('dashboard.categories.index'),
                        'permissions' => ['categories.list', 'categories.edit', 'categories.delete'],
                    ],
                    [
                        'title' => 'Create Category',
                        'link' => route('dashboard.categories.create'),
                        'permissions' => ['categories.create'],
                    ],
                ]" />




            <x-dashboard.sidebar.link-with-child title="Tours" icon="grid" :permissions="['tours.list', 'tours.create', 'tours.edit', 'tours.delete','tours.show']" :children="[
                [
                    'title' => 'Tours',
                    'link' => route('dashboard.tours.index'),
                    'permissions' => ['tours.list', 'tours.edit', 'tours.delete','tours.show'],
                ],
                [
                    'title' => 'Create Tour',
                    'link' => route('dashboard.tours.create'),
                    'permissions' => ['tours.create'],
                ],
            ]" />

            <x-dashboard.sidebar.link-with-child
                title="Tour Options"
                icon="check-square"
                :permissions="['tour-options.list','tour-options.create','tour-options.edit','tour-options.delete']"
                :children="[
                    ['title' => 'Tour Options', 'link' => route('dashboard.tour-options.index'), 'permissions' => ['tour-options.list','tour-options.edit','tour-options.delete'] ],
                    ['title' => 'Create Tour Option', 'link' => route('dashboard.tour-options.create'), 'permissions' => ['tour-options.create'] ],
                ]"
            />

            <x-dashboard.sidebar.link-with-child title="Pricing" icon="dollar-sign" :permissions="['discounts.list', 'discounts.create', 'discounts.edit', 'discounts.delete', 'discounts.restore','raises.list', 'raises.create', 'raises.edit', 'raises.delete', 'raises.restore']" :children="[
                [
                    'title' => 'Add Discount',
                    'link' => route('dashboard.discounts.create'),
                    'permissions' => ['discounts.list', 'discounts.create', 'discounts.edit', 'discounts.delete', 'discounts.restore'],
                ],
                [
                    'title' => 'Add Raise',
                    'link' => route('dashboard.raises.create'),
                    'permissions' => ['raises.list', 'raises.create', 'raises.edit', 'raises.delete', 'raises.restore'],
                ],
            ]" />
            <x-dashboard.sidebar.link-with-child title="Subscriptions" icon="grid" :permissions="['subscribes.list', 'subscribes.create', 'subscribes.edit', 'subscribes.delete','subscribes.show','email']" :children="[
                [
                    'title' => 'All Subscriptions',
                    'link' => route('dashboard.subscribes.index'),
                    'permissions' => ['subscribes.list', 'subscribes.edit', 'subscribes.delete','subscribes.show'],
                ],
                [
                    'title' => 'Send Email',
                    'link' => route('dashboard.email'),
                    'permissions' => ['email'],
                ],
            ]" />
            <x-dashboard.sidebar.link-with-child
                title="Sliders"
                icon="image"
                :permissions="['sliders.list','sliders.create','sliders.edit','sliders.delete']"
                :children="[
                    ['title' => 'Sliders', 'link' => route('dashboard.sliders.index'), 'permissions' => ['sliders.list','sliders.edit','sliders.delete'] ],
                    ['title' => 'Create Slider', 'link' => route('dashboard.sliders.create'), 'permissions' => ['sliders.create'] ],
                ]"
            />

            <x-dashboard.sidebar.link-with-child title="Bookings" icon="activity" :permissions="['bookings.list', 'bookings.create']" :children="[
                [
                    'title' => 'Bookings',
                    'link' => route('dashboard.bookings.index'),
                    'permissions' => ['bookings.list'],
                ],
                [
                    'title' => 'Create Booking',
                    'link' => route('dashboard.bookings.create'),
                    'permissions' => ['bookings.create'],
                ],
            ]" />
                    <x-dashboard.sidebar.link-with-child title="FAQs" icon="book-open" :permissions="['faq-categories.list', 'faq-categories.create','faq-categories.edit', 'faq-categories.delete', 'faqs.list', 'faqs.create', 'faqs.edit', 'faqs.delete']"
                    :children="[
                        [
                            'title' => 'FAQ Categories',
                            'link' => route('dashboard.faq-categories.index'),
                            'permissions' => ['faq-categories.list', 'faq-categories.edit', 'faq-categories.delete'],
                        ],
                        [
                            'title' => 'FAQs',
                            'link' => route('dashboard.faqs.index'),
                            'permissions' => ['faqs.list', 'faqs.create'],
                        ],
                    ]"
                />



                <x-dashboard.sidebar.link-with-child title="Blogs" icon="book-open" :permissions="['blog-categories.list', 'blog-categories.create', 'blog-categories.edit', 'blog-categories.delete', 'blog-categories.restore','blogs.list', 'blogs.create', 'blogs.edit', 'blogs.delete', 'blogs.restore']"
                :children="[
                    [
                        'title' => 'Blogs Categories',
                        'link' => route('dashboard.blog-categories.index'),
                        'permissions' => ['blog-categories.list', 'blog-categories.edit', 'blog-categories.delete'],
                    ],
                    [
                        'title' => 'Blogs',
                        'link' => route('dashboard.blogs.index'),
                        'permissions' => ['blogs.list', 'blogs.create', 'blogs.edit', 'blogs.delete', 'blogs.restore'],
                    ],
                    [
                        'title' => 'Create Blogs',
                        'link' => route('dashboard.blogs.create'),
                        'permissions' => ['blogs.create'],
                    ],
                ]" />
                <x-dashboard.sidebar.link-with-child title="Reports" icon="book-open" :permissions="['bookings.list', 'bookings.create']"
                :children="[
                    [
                        'title' => 'Total Sells Report',
                        'link' => route('dashboard.sells'),
                        'permissions' => ['bookings.list', 'bookings.create'],
                    ],
                    [
                        'title' => 'Tours Report',
                        'link' => route('dashboard.tours-search'),
                    ],
                ]" />
            <x-dashboard.sidebar.single-link :permissions="'appointments.list'" title="Appointments" link="{{ route('dashboard.appointments.index') }}" icon="calendar" />

            <x-dashboard.sidebar.single-link :permissions="['settings.show']" title="Settings" link="{{ route('dashboard.settings.show') }}" icon="settings" />

            <x-dashboard.sidebar.link-with-child
                title="Contacts"
                icon="book-open"
                :permissions="['contacts.list','contacts.create','contacts.edit','contacts.delete']"
                :children="[
                    ['title' => 'Contacts', 'link' => route('dashboard.contacts.index'), 'permissions' => ['contacts.list','contacts.edit','contacts.delete'] ],
                    ['title' => 'Create Contact', 'link' => route('dashboard.contacts.create'), 'permissions' => ['contacts.create'] ],
                ]"
            />

            {{--Sidebar Auto Generation--}}

            <x-dashboard.sidebar.single-link title="Logout" link="{{ route('logout') }}" icon="log-in" />

        </ul>
    </div>
</div>
<!-- Page Sidebar Ends-->
