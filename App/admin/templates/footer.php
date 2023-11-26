</div>
</div>

<script src="../../libreries/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="../../libreries/Popper/popper.min.js"></script>
    <script src="../../libreries/Vue/vue.js"></script>
    <script src="../../libreries/jquery/jquery-3.3.1.min.js"></script>
    <script src="../../libreries/Axios/axios.js"></script>
    <script src="../../libreries/bootstrap/bootstrap.min.js"></script>

<script>
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#content-wrapper").toggleClass("toggled");
});

</script>

<script>
function showTable(tableName) {

    hideAllTables();
    document.getElementById(tableName + 'Table').style.display = 'block';
}

function hideAllTables() {

    const tables = document.querySelectorAll('[id$="Table"]');
    tables.forEach(table => {
        table.style.display = 'none';
    });
}
</script>
</body>

</html>