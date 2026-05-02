{{-- This view renders a <script> tag injected before </body> --}}
<script>
    (function () {
        let style = '{{ config('zopen.console.style') }}';
        let message = '{{ config('zopen.console.message') }}';

        console.log('%c' + message, style);
        console.log('%c⚡ ' + '{{ config('zopen.html_comment.website') }}', 'color: #94a3b8; font-size: 12px;');
        console.log('%c🐙 ' + '{{ config('zopen.html_comment.github') }}', 'color: #94a3b8; font-size: 12px;');
        console.log('%c🇪🇺 Built in Europe. Privacy-first. No lock-in.', 'color: #94a3b8; font-size: 11px; font-style: italic;');
    })();
</script>
