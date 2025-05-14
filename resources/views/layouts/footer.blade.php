<footer class="bg-dark text-white text-center py-1">
    <div class="container d-flex align-items-center justify-content-between">

        <img id="secretLogo" src="{{ asset('images/icon_logo.png') }}" class="img-fluid" style="max-width: 80px; cursor: pointer;" alt="logo">

        <div class="text-center text-white flex-grow-1">
            <p>&copy; {{ date('Y') }} Jyn Production. All Rights Reserved.</p>
        </div>
    </div>
</footer>   

<script>
    let tapCount = 0;
    const logo = document.getElementById("secretLogo");

    logo.addEventListener("click", function () {
        tapCount++;

        if (tapCount === 5) {
            window.location.href = "/login";
        }

        setTimeout(() => {
            tapCount = 0;
        }, 2000);
    });
</script>
