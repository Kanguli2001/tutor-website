@include('layouts.app', [
    'slot' => $slot,
    'title' => $title ?? 'Mawey Tutorials',
    'active' => $active ?? '',
])
