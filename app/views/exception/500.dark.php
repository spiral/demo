<extends:layout.base title="Something went wrong"/>

<stack:push name="styles">
    <link rel="stylesheet" href="/styles/welcome.css"/>
</stack:push>

<define:body>
    <div class="wrapper">
        <div class="placeholder">
            <img src="/images/500.svg" alt="Error 500" width="300px"/>
            <h2>Something went wrong</h2>

            <div style="font-size: 12px; margin-top: 10px;">
                This view file is located in <b>app/views/exception/500.dark.php</b>.
            </div>
        </div>
    </div>
</define:body>
