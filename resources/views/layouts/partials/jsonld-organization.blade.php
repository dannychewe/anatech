@php
  $orgJson = [
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => 'Analytical Technologies Zambia Ltd (Anatech)',
    'url' => url('/'),
    'logo' => asset('assets/img/logo/logo.png'),
    'description' => trim($__env->yieldContent('meta_description')) ?: 
      'Anatech supplies laboratory equipment, scientific instruments, chemicals, consumables and industrial solutions across Zambia. We serve food & beverage, pharmaceuticals, mining, environmental science, manufacturing and research institutions.',
    
    'areaServed' => [
        'Zambia',
        'Southern Africa',
        'Africa'
    ],

    'sameAs' => array_values(array_filter([
        trim($__env->yieldContent('org_facebook')),
        trim($__env->yieldContent('org_linkedin')),
        trim($__env->yieldContent('org_instagram')),
        trim($__env->yieldContent('org_twitter')),
        trim($__env->yieldContent('org_youtube')),
    ])),

    'contactPoint' => [[
        '@type' => 'ContactPoint',
        'contactType' => 'Customer Support',
        'telephone' => trim($__env->yieldContent('org_phone')) ?: '+260 000 000 000',
        'email' => trim($__env->yieldContent('org_email')) ?: 'info@anatech.co.zm',
        'areaServed' => 'ZM',
        'availableLanguage' => ['English']
    ]],
  ];
@endphp

<script type="application/ld+json">
{!! json_encode($orgJson, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

@stack('structured_data')
