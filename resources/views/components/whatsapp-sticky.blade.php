@props(['phone'])

<a
  href="https://wa.me/{{ $phone }}"
  class="mtz-wa-sticky"
  target="_blank"
  rel="noopener noreferrer"
  aria-label="WhatsApp"
>
  <x-icon-whatsapp class="w-7 h-7" fill="white"/>
</a>
