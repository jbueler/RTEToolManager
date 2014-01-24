<table border="0" cellspacing="0" cellpadding="0" class="mainTable">
  <tr><th>Name</th><th>Class name</th><th>Enabled</th><th>&nbsp;</th></tr>
  <!-- Begin tools loop -->
  <?php foreach ($available_tools as $tool): ?>
    <?php 
      $enabled =  (isset($installed_tools[$tool['package']]) && $installed_tools[$tool['package']]['enabled'] == 'y') ? "yes" : "no";
      $toggle_url = ($enabled == 'yes') ? $disable_url.$tool['class'] : $enable_url.$tool['class'];
    ?>
    
    <tr>
      <td><?= $tool['name'] ?></td>
      <td><?= $tool['class'] ?></td>
      <td><?= $enabled ?></td>
      <td><a href="<?= $toggle_url ?>"><?= ($enabled == 'yes')? "Disable?" : "Enable?" ?></a></td>
    </tr>
  <?php endforeach ?>
  <!-- End tools loop -->
</table>