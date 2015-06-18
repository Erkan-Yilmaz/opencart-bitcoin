<?php
/**
 * LICENSE
 *
 * This source file is subject to the GNU General Public License, Version 3
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @category   OpenCart
 * @package    Bitcoin Payment for OpenCart
 * @copyright  Copyright (c) 2015 Eugene Lifescale (a.k.a. Shaman) by OpenCart Ukrainian Community (http://opencart-ukraine.tumblr.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License, Version 3
 */
 ?>

<?php if ($address) { ?>
  <h2><?php echo $text_instruction; ?></h2>
  <div class="row">
    <div class="col-sm-2" style="text-align: center">
      <?php if ($qr) { ?>
        <img src="<?php echo $qr; ?>" alt="<?php echo $address; ?>" title="<?php echo $address; ?>">
      <?php } ?>
    </div>
    <div class="col-sm-10">
      <p>&nbsp;</p>
      <p><b><?php echo $text_description; ?></b></p>
      <p><pre><?php echo $address; ?></pre></p>
    </div>
  </div>
  <div class="buttons">
    <div class="pull-right">
      <input type="button" value="<?php echo $button_confirm; ?>" id="button-confirm" class="btn btn-primary" data-loading-text="<?php echo $text_loading; ?>" />
    </div>
  </div>
  <script type="text/javascript"><!--
  $('#button-confirm').on('click', function() {
    $.ajax({
      type: 'get',
      url: 'index.php?route=payment/bitcoin/confirm',
      cache: false,
      beforeSend: function() {
        $('#button-confirm').button('loading');
      },
      complete: function() {
        $('#button-confirm').button('reset');
      },
      success: function() {
        location = '<?php echo $continue; ?>';
      }
    });
  });
  //--></script>
<?php } ?>
