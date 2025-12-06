<footer>
    <p>&copy; <?php echo date('Y'); ?> <?php echo $full_name; ?> | IT Student Portfolio</p>
</footer>
    <script src="script.js?=<?php echo time()?>"></script>
</body>
</html>
<?php mysqli_close($conn); ?>