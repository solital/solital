    <script>
        function showInfo() {
            document.getElementById("info").innerHTML = 
            "<a href='#' class='btn-info' onclick='hideInfo();'>Close info</a>" +
            "<div style='background-color: #DCDCDC; padding: 1px;'>" +
                "<p style='font-weight: bold;'>Vinci Version: 0.2.0</p><hr>" +
                "<p style='font-weight: bold;'>Solital Version: 0.8.0</p><hr>" +
                "<a href='#' style='color: #104E8B; text-decoration: none;'>See documentation</a><hr>" +
            "</div>";
            document.getElementById("bInfo").innerHTML = "";
        }

        function hideInfo(){
            document.getElementById("info").innerHTML = "";
            document.getElementById("bInfo").innerHTML = "Show info";
        }
    </script>
</body>

</html>