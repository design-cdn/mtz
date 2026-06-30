<footer class="mtz-footer">
  <div class="mtz-footer__inner">
    <div>
      <p class="mtz-footer__logo">{{ __('footer.logo') }}</p>
      <p class="mtz-footer__copy">{{ __('footer.copy') }}</p>
    </div>
    <div class="flex gap-8 flex-wrap items-center">
      <a class="mtz-footer__link" href="#" rel="noopener noreferrer">{{ __('footer.facebook') }}</a>
      <a class="mtz-footer__link" href="#" rel="noopener noreferrer">{{ __('footer.instagram') }}</a>
      <a class="mtz-footer__link" href="{{ route('legal.confidentialitate') }}">{{ __('footer.privacy') }}</a>
      <a class="mtz-footer__link" href="{{ route('legal.gdpr') }}">{{ __('footer.gdpr') }}</a>
      <a class="mtz-footer__anpc"
         href="https://anpc.ro/ce-este-sal/"
         target="_blank"
         rel="noopener noreferrer"
         aria-label="ANPC — Soluționarea Alternativă a Litigiilor">
        <img src="{{ asset('images/anpc.svg') }}" alt="ANPC — Soluționarea Alternativă a Litigiilor (SAL)" width="205" height="45"/>
      </a>
    </div>
  </div>
</footer>
