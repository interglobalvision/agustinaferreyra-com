
</section>

<?php
if (!is_home() && !is_singular('post')) {
  get_template_part('partials/footer-content');
}
?>

<?php
get_template_part('partials/scripts');
get_template_part('partials/schema-org');
?>

</body>
</html>
