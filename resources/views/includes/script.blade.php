        <script>
            function updateTime() {
                const now = new Date();

                const hourElement = document.getElementById("hour");
                const minuteElement = document.getElementById("minute");
                const secondElement = document.getElementById("second");

                const hour = now.getHours().toString().padStart(2, "0");
                const minute = now.getMinutes().toString().padStart(2, "0");
                const second = now.getSeconds().toString().padStart(2, "0");

                hourElement.textContent = hour;
                minuteElement.textContent = minute;
                secondElement.textContent = second;
            }

            setInterval(updateTime, 1000);
        </script>

        <!-- Bootstrap core JavaScript -->

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
            integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script>
            AOS.init();
        </script>
        <script src="/script/navbar-scroll.js"></script>
        <script>
            const toast = new bootstrap.Toast('.toast');

            setTimeout(function() {
                toast.show();
            }, 1000);
        </script>
