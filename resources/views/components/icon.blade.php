@props(['name', 'class' => ''])
@php($n = strtolower($name ?? ''))
@switch($n)
    @case('bed')
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="currentColor" class="{{ $class }}" role="img" aria-label="Cama">
            <path d="M3 6a1 1 0 0 0-1 1v10h2v-2h16v2h2V11a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3v1H4V7a1 1 0 0 0-1-1Zm7 5a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v1h-8v-1Zm-5-2h3a1 1 0 0 1 1 1v2H5V9Z"/>
        </svg>
        @break
    @case('shower')
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="currentColor" class="{{ $class }}" role="img" aria-label="Chuveiro">
            <path d="M7 5a6 6 0 0 1 6-6v2a4 4 0 0 0-4 4H7Z" transform="translate(2,3)"/>
            <path d="M3 6h10a3 3 0 0 1 3 3v1H3V6Z" />
            <circle cx="6" cy="14" r="1"/><circle cx="10" cy="14" r="1"/><circle cx="14" cy="14" r="1"/>
            <circle cx="8" cy="17" r="1"/><circle cx="12" cy="17" r="1"/><circle cx="16" cy="17" r="1"/>
        </svg>
        @break
    @default
        <span class="{{ $class }}" aria-hidden="true"></span>
@endswitch

