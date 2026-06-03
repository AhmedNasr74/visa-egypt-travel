<?php
/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => false,
            'titleBefore'  => false,
            'description'  => false,
            'separator'    => ' | ',
            'keywords'     => [],
            'canonical'    => 'current',
            'robots'       => 'index,follow',
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => false,
            'description' => false,
            'url'         => 'current',
            'type'        => 'website',
            'site_name'   => env('MAIL_BRAND_NAME', env('APP_NAME', 'Visa Egypt Travel')),
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            'card' => 'summary_large_image',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => false,
            'description' => false,
            'url'         => 'current',
            'type'        => 'WebPage',
            'images'      => [],
        ],
    ],
];
