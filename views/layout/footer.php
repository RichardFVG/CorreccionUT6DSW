<!-- views/layout/footer.php -->

    <!-- 1. Inicio del pie de página -->
    <footer>
        <!-- 2. Muestro el año dinámicamente 
        y el nombre -->
        <p>&copy; <?php echo date("Y"); ?>
            Richard Francisco Vaca Garcia, 2do CFGS DAW
        </p>
    </footer>

    <!-- 3. Incluyo la librería Axios para 
    peticiones HTTP -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- 4. Fichero principal de JS de la 
    aplicación -->
    <script src="../../public/js/app.js"></script>

<!-- 5. Cierre de body y html (se abren en header.php) -->
</body>
</html>
