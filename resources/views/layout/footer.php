    <script>
        window.APP_CONFIG = <?= json_encode($jsConfig, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) ?>;
    </script>
    <script src="<?= e(asset('resources/js/calculator.js')) ?>" defer></script>
</body>
</html>