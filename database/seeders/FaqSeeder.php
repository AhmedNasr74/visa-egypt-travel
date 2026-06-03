<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $categories = $this->categories();

        foreach ($categories as $categoryData) {
            $category = $this->seedCategory($categoryData);

            foreach ($categoryData['faqs'] as $faqData) {
                $this->seedFaq($category, $faqData);
            }
        }
    }

    private function seedCategory(array $data): FaqCategory
    {
        $existing = FaqCategory::whereTranslation('title', $data['en']['title'], 'en')->first();

        if ($existing) {
            return $existing;
        }

        return FaqCategory::create([
            'en' => ['title' => $data['en']['title']],
            'fr' => ['title' => $data['fr']['title']],
            'es' => ['title' => $data['es']['title']],
            'pt' => ['title' => $data['pt']['title']],
        ]);
    }

    private function seedFaq(FaqCategory $category, array $data): void
    {
        if (Faq::whereTranslation('question', $data['en']['question'], 'en')->exists()) {
            return;
        }

        Faq::create([
            'category_id' => $category->id,
            'enabled' => $data['enabled'] ?? true,
            'home' => $data['home'] ?? false,
            'important' => $data['important'] ?? false,
            'en' => [
                'question' => $data['en']['question'],
                'answer' => $data['en']['answer'],
            ],
            'fr' => [
                'question' => $data['fr']['question'],
                'answer' => $data['fr']['answer'],
            ],
            'es' => [
                'question' => $data['es']['question'],
                'answer' => $data['es']['answer'],
            ],
            'pt' => [
                'question' => $data['pt']['question'],
                'answer' => $data['pt']['answer'],
            ],
        ]);
    }

    private function categories(): array
    {
        return [
            [
                'en' => ['title' => 'Booking & Payments'],
                'fr' => ['title' => 'Réservation et paiements'],
                'es' => ['title' => 'Reservas y pagos'],
                'pt' => ['title' => 'Reservas e pagamentos'],
                'faqs' => [
                    [
                        'important' => true,
                        'home' => true,
                        'en' => [
                            'question' => 'How do I book a tour with Visa Egypt Travel?',
                            'answer' => 'Browse our tours online, select your dates and group size, then complete the booking form. You can also contact us by phone, email, or WhatsApp and our team will prepare a quote for you.',
                        ],
                        'fr' => [
                            'question' => 'Comment réserver une excursion avec Visa Egypt Travel ?',
                            'answer' => 'Parcourez nos circuits en ligne, choisissez vos dates et le nombre de voyageurs, puis remplissez le formulaire de réservation. Vous pouvez aussi nous contacter par téléphone, e-mail ou WhatsApp.',
                        ],
                        'es' => [
                            'question' => '¿Cómo reservo un tour con Visa Egypt Travel?',
                            'answer' => 'Explore nuestros tours en línea, seleccione fechas y número de viajeros y complete el formulario de reserva. También puede contactarnos por teléfono, correo o WhatsApp.',
                        ],
                        'pt' => [
                            'question' => 'Como reservo um tour com a Visa Egypt Travel?',
                            'answer' => 'Navegue pelos nossos tours online, escolha as datas e o tamanho do grupo e preencha o formulário de reserva. Também pode contactar-nos por telefone, e-mail ou WhatsApp.',
                        ],
                    ],
                    [
                        'home' => true,
                        'en' => [
                            'question' => 'What payment methods do you accept?',
                            'answer' => 'We accept bank transfer, major credit cards, and cash on arrival for selected services. Payment terms and deposit amounts are confirmed in your booking confirmation.',
                        ],
                        'fr' => [
                            'question' => 'Quels modes de paiement acceptez-vous ?',
                            'answer' => 'Nous acceptons le virement bancaire, les principales cartes de crédit et, pour certains services, les espèces à l\'arrivée. Les conditions sont précisées dans votre confirmation.',
                        ],
                        'es' => [
                            'question' => '¿Qué métodos de pago aceptan?',
                            'answer' => 'Aceptamos transferencia bancaria, tarjetas de crédito principales y efectivo a la llegada en servicios seleccionados. Los términos se confirman en su reserva.',
                        ],
                        'pt' => [
                            'question' => 'Que métodos de pagamento aceitam?',
                            'answer' => 'Aceitamos transferência bancária, cartões de crédito principais e dinheiro à chegada em serviços selecionados. Os termos são confirmados na reserva.',
                        ],
                    ],
                    [
                        'en' => [
                            'question' => 'Can I change or cancel my booking?',
                            'answer' => 'Yes. Changes and cancellations depend on the tour type and how close you are to the travel date. Contact us as early as possible and we will explain applicable fees and alternatives.',
                        ],
                        'fr' => [
                            'question' => 'Puis-je modifier ou annuler ma réservation ?',
                            'answer' => 'Oui. Les conditions dépendent du circuit et de la proximité de la date de voyage. Contactez-nous le plus tôt possible pour connaître les frais et options.',
                        ],
                        'es' => [
                            'question' => '¿Puedo cambiar o cancelar mi reserva?',
                            'answer' => 'Sí. Las condiciones dependen del tour y de la proximidad de la fecha. Contáctenos lo antes posible para conocer tasas y alternativas.',
                        ],
                        'pt' => [
                            'question' => 'Posso alterar ou cancelar a minha reserva?',
                            'answer' => 'Sim. As condições dependem do tour e da proximidade da data. Contacte-nos o mais cedo possível para saber taxas e alternativas.',
                        ],
                    ],
                ],
            ],
            [
                'en' => ['title' => 'Tours & Itineraries'],
                'fr' => ['title' => 'Circuits et itinéraires'],
                'es' => ['title' => 'Tours e itinerarios'],
                'pt' => ['title' => 'Tours e itinerários'],
                'faqs' => [
                    [
                        'important' => true,
                        'en' => [
                            'question' => 'Do you offer private and group tours?',
                            'answer' => 'Yes. We offer private tours for families and small groups, as well as shared group departures on popular routes. Tell us your preferences and we will recommend the best option.',
                        ],
                        'fr' => [
                            'question' => 'Proposez-vous des circuits privés et en groupe ?',
                            'answer' => 'Oui. Nous proposons des circuits privés et des départs en groupe sur les routes populaires. Indiquez vos préférences et nous vous conseillerons.',
                        ],
                        'es' => [
                            'question' => '¿Ofrecen tours privados y en grupo?',
                            'answer' => 'Sí. Ofrecemos tours privados y salidas en grupo en rutas populares. Indíquenos sus preferencias y le recomendaremos la mejor opción.',
                        ],
                        'pt' => [
                            'question' => 'Oferecem tours privados e em grupo?',
                            'answer' => 'Sim. Oferecemos tours privados e partidas em grupo em rotas populares. Indique as suas preferências e recomendaremos a melhor opção.',
                        ],
                    ],
                    [
                        'home' => true,
                        'en' => [
                            'question' => 'Can you customize my Egypt itinerary?',
                            'answer' => 'Absolutely. Use our Customize Your Trip form or speak with an advisor. We can combine Cairo, Luxor, Aswan, Nile cruises, desert trips, and airport transfers into one tailored plan.',
                        ],
                        'fr' => [
                            'question' => 'Pouvez-vous personnaliser mon itinéraire en Égypte ?',
                            'answer' => 'Absolument. Utilisez notre formulaire ou parlez à un conseiller. Nous combinons Le Caire, Louxor, Assouan, croisières sur le Nil et transferts aéroport.',
                        ],
                        'es' => [
                            'question' => '¿Pueden personalizar mi itinerario en Egipto?',
                            'answer' => 'Por supuesto. Use nuestro formulario o hable con un asesor. Combinamos El Cairo, Luxor, Asuán, cruceros por el Nilo y traslados al aeropuerto.',
                        ],
                        'pt' => [
                            'question' => 'Podem personalizar o meu itinerário no Egito?',
                            'answer' => 'Com certeza. Use o nosso formulário ou fale com um consultor. Combinamos Cairo, Luxor, Assuão, cruzeiros no Nilo e transfers aeroportuários.',
                        ],
                    ],
                    [
                        'en' => [
                            'question' => 'Are entrance fees and guides included?',
                            'answer' => 'Inclusions vary by tour. Most packages list whether Egyptologist guides, tickets, meals, and transport are included. Your quotation and voucher specify exactly what is covered.',
                        ],
                        'fr' => [
                            'question' => 'Les frais d\'entrée et les guides sont-ils inclus ?',
                            'answer' => 'Les inclusions varient selon le circuit. La plupart des forfaits précisent guides, billets, repas et transport. Votre devis et bon détaillent le contenu.',
                        ],
                        'es' => [
                            'question' => '¿Están incluidas las entradas y los guías?',
                            'answer' => 'Las inclusiones varían según el tour. La mayoría indica guías, entradas, comidas y transporte. Su presupuesto y voucher especifican el detalle.',
                        ],
                        'pt' => [
                            'question' => 'As entradas e guias estão incluídas?',
                            'answer' => 'As inclusões variam por tour. A maioria indica guias, bilhetes, refeições e transporte. O orçamento e voucher especificam o que está incluído.',
                        ],
                    ],
                ],
            ],
            [
                'en' => ['title' => 'Visa & Travel Documents'],
                'fr' => ['title' => 'Visa et documents de voyage'],
                'es' => ['title' => 'Visa y documentos de viaje'],
                'pt' => ['title' => 'Visto e documentos de viagem'],
                'faqs' => [
                    [
                        'important' => true,
                        'home' => true,
                        'en' => [
                            'question' => 'Do I need a visa to visit Egypt?',
                            'answer' => 'Most visitors need a visa. Many nationalities can obtain an e-visa online before travel or a visa on arrival at Egyptian airports. Requirements depend on your passport; check official government sources before you fly.',
                        ],
                        'fr' => [
                            'question' => 'Ai-je besoin d\'un visa pour visiter l\'Égypte ?',
                            'answer' => 'La plupart des visiteurs ont besoin d\'un visa. De nombreuses nationalités peuvent obtenir un e-visa en ligne ou un visa à l\'arrivée. Vérifiez les règles officielles selon votre passeport.',
                        ],
                        'es' => [
                            'question' => '¿Necesito visa para visitar Egipto?',
                            'answer' => 'La mayoría de los visitantes necesitan visa. Muchas nacionalidades pueden obtener e-visa en línea o visa a la llegada. Consulte las fuentes oficiales según su pasaporte.',
                        ],
                        'pt' => [
                            'question' => 'Preciso de visto para visitar o Egito?',
                            'answer' => 'A maioria dos visitantes precisa de visto. Muitas nacionalidades podem obter e-visa online ou visto à chegada. Verifique as regras oficiais do seu passaporte.',
                        ],
                    ],
                    [
                        'en' => [
                            'question' => 'What is the best time to visit Egypt?',
                            'answer' => 'October through April offers cooler weather ideal for sightseeing. Summer is hotter but can mean fewer crowds and lower prices. Nile cruises and Red Sea resorts operate year-round.',
                        ],
                        'fr' => [
                            'question' => 'Quelle est la meilleure période pour visiter l\'Égypte ?',
                            'answer' => 'D\'octobre à avril, le climat est plus frais pour les visites. L\'été est plus chaud mais moins fréquenté. Croisières et stations de la mer Rouge fonctionnent toute l\'année.',
                        ],
                        'es' => [
                            'question' => '¿Cuál es la mejor época para visitar Egipto?',
                            'answer' => 'De octubre a abril hace un clima más fresco para visitar. El verano es más caluroso pero con menos multitudes. Cruceros y resorts del Mar Rojo operan todo el año.',
                        ],
                        'pt' => [
                            'question' => 'Qual é a melhor época para visitar o Egito?',
                            'answer' => 'De outubro a abril o clima é mais ameno para passeios. O verão é mais quente mas com menos multidões. Cruzeiros e resorts do Mar Vermelho funcionam o ano todo.',
                        ],
                    ],
                ],
            ],
            [
                'en' => ['title' => 'Transportation & Limo'],
                'fr' => ['title' => 'Transport et limousine'],
                'es' => ['title' => 'Transporte y limusina'],
                'pt' => ['title' => 'Transporte e limusina'],
                'faqs' => [
                    [
                        'home' => true,
                        'en' => [
                            'question' => 'Do you provide airport transfers?',
                            'answer' => 'Yes. We arrange airport limousine and private transfers in Cairo, Luxor, Aswan, Hurghada, Sharm El Sheikh, and other cities. Book online through our Transfer section or contact us with your flight details.',
                        ],
                        'fr' => [
                            'question' => 'Proposez-vous des transferts aéroport ?',
                            'answer' => 'Oui. Nous organisons des transferts en limousine et privés au Caire, Louxor, Assouan, Hurghada, Charm el-Cheikh et ailleurs. Réservez en ligne ou contactez-nous avec vos vols.',
                        ],
                        'es' => [
                            'question' => '¿Ofrecen traslados al aeropuerto?',
                            'answer' => 'Sí. Organizamos traslados en limusina y privados en El Cairo, Luxor, Asuán, Hurghada, Sharm El Sheikh y más. Reserve en línea o contáctenos con sus vuelos.',
                        ],
                        'pt' => [
                            'question' => 'Fornecem transfers aeroportuários?',
                            'answer' => 'Sim. Organizamos transfers em limusina e privados no Cairo, Luxor, Assuão, Hurghada, Sharm El Sheikh e mais. Reserve online ou contacte-nos com os voos.',
                        ],
                    ],
                    [
                        'en' => [
                            'question' => 'How far in advance should I book a limo?',
                            'answer' => 'We recommend booking at least 24–48 hours before pickup. For peak season, holidays, or large groups, book earlier to secure your preferred vehicle and price.',
                        ],
                        'fr' => [
                            'question' => 'Combien de temps à l\'avance réserver une limousine ?',
                            'answer' => 'Nous recommandons de réserver 24 à 48 heures avant la prise en charge. En haute saison ou pour les groupes, réservez plus tôt.',
                        ],
                        'es' => [
                            'question' => '¿Con cuánta anticipación debo reservar la limusina?',
                            'answer' => 'Recomendamos reservar al menos 24–48 horas antes. En temporada alta o grupos grandes, reserve antes para asegurar vehículo y precio.',
                        ],
                        'pt' => [
                            'question' => 'Com quanta antecedência devo reservar a limusina?',
                            'answer' => 'Recomendamos reservar pelo menos 24–48 horas antes. Em época alta ou grupos grandes, reserve mais cedo para garantir veículo e preço.',
                        ],
                    ],
                ],
            ],
            [
                'en' => ['title' => 'General Information'],
                'fr' => ['title' => 'Informations générales'],
                'es' => ['title' => 'Información general'],
                'pt' => ['title' => 'Informações gerais'],
                'faqs' => [
                    [
                        'important' => true,
                        'en' => [
                            'question' => 'What languages do your guides speak?',
                            'answer' => 'Our licensed guides commonly speak English and Arabic. French, Spanish, German, and other languages may be available on request depending on availability.',
                        ],
                        'fr' => [
                            'question' => 'Quelles langues parlent vos guides ?',
                            'answer' => 'Nos guides licenciés parlent généralement anglais et arabe. Français, espagnol, allemand et autres langues peuvent être disponibles sur demande.',
                        ],
                        'es' => [
                            'question' => '¿Qué idiomas hablan sus guías?',
                            'answer' => 'Nuestros guías autorizados suelen hablar inglés y árabe. Francés, español, alemán y otros idiomas pueden estar disponibles bajo solicitud.',
                        ],
                        'pt' => [
                            'question' => 'Que idiomas falam os seus guias?',
                            'answer' => 'Os nossos guias licenciados falam normalmente inglês e árabe. Francês, espanhol, alemão e outros podem estar disponíveis mediante pedido.',
                        ],
                    ],
                    [
                        'home' => true,
                        'en' => [
                            'question' => 'How can I contact Visa Egypt Travel?',
                            'answer' => 'Reach us by phone at +20 100 505 5952, email at info@visaegypttravel.com, or WhatsApp. Our team replies during business hours and monitors urgent travel requests.',
                        ],
                        'fr' => [
                            'question' => 'Comment contacter Visa Egypt Travel ?',
                            'answer' => 'Par téléphone au +20 100 505 5952, par e-mail à info@visaegypttravel.com ou via WhatsApp. Notre équipe répond aux heures ouvrables.',
                        ],
                        'es' => [
                            'question' => '¿Cómo contacto a Visa Egypt Travel?',
                            'answer' => 'Por teléfono +20 100 505 5952, correo info@visaegypttravel.com o WhatsApp. Respondemos en horario laboral y urgencias de viaje.',
                        ],
                        'pt' => [
                            'question' => 'Como contacto a Visa Egypt Travel?',
                            'answer' => 'Por telefone +20 100 505 5952, e-mail info@visaegypttravel.com ou WhatsApp. Respondemos no horário comercial e pedidos urgentes.',
                        ],
                    ],
                    [
                        'en' => [
                            'question' => 'Is Egypt safe for tourists?',
                            'answer' => 'Millions of tourists visit Egypt each year. We work with vetted partners and licensed guides. Follow local advice, use registered transport, and keep copies of your passport and travel insurance details.',
                        ],
                        'fr' => [
                            'question' => 'L\'Égypte est-elle sûre pour les touristes ?',
                            'answer' => 'Des millions de touristes visitent l\'Égypte chaque année. Nous travaillons avec des partenaires agréés. Suivez les conseils locaux et utilisez des transports officiels.',
                        ],
                        'es' => [
                            'question' => '¿Es seguro Egipto para turistas?',
                            'answer' => 'Millones de turistas visitan Egipto cada año. Trabajamos con socios verificados y guías con licencia. Siga consejos locales y use transporte registrado.',
                        ],
                        'pt' => [
                            'question' => 'O Egito é seguro para turistas?',
                            'answer' => 'Milhões de turistas visitam o Egito todos os anos. Trabalhamos com parceiros verificados e guias licenciados. Siga conselhos locais e use transporte registado.',
                        ],
                    ],
                ],
            ],
        ];
    }
}
