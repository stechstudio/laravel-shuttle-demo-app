<?php

declare(strict_types=1);

return [

    /**
     * The URL endpoint used to trigger the
     * upload process.
     */
    'url_prefix' => '/uploader',

    /**
     * The disk you want to use for file uploads. This
     * must be a disk that uses the S3 driver.
     */
    'disk' => 's3',

    /**
     * The authentication guard used for authorization.
     */
    'guard' => 'web',

    /**
     * The background colors used for the file uploader UI.
     * You can customise the color for each state. You can
     * use any valid Tailwind background class. If you
     * need to specify a custom HEX value, create a
     * new color variable in your Tailwind config
     * file. Custom HEX values are not compiled
     * at run time.
     */
    'colors' => [

        'details-panel' => [
            'uploading' => 'bg-orange-500',

            'upload-success' => 'bg-green-500',

            'upload-error' => 'bg-red-500',
        ],

    ],

];
