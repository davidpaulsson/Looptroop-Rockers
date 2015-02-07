<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Looptroop Rockers v5
 */
?>

  </div><!-- #content -->

  <footer id="colophon" class="site-footer" role="contentinfo">
    <div class="site-info">

      <div class="site-footer__logo">
        <img src="<?php echo get_template_directory_uri() ?>/img/ltrlogo.png">
      </div>

      <div class="site-footer__contact">
        <h3>Contact</h3>
        <p><a href="https://twitter.com/looptroopdvsg/" rel="me">Hit us up on Twitter</a> or use one of the e-mail addresses listed here.</p>

        <h3>Bookings</h3>
        <ul>
          <li>
            <a href="mailto:ola@luger.se">Ola Broquist</a><br>
            <a href="http://www.luger.se">www.luger.se</a><br>
            +46 (0) 8-578 679 00
          </li>
        </ul>
      </div>

      <div class="site-footer__press">
        <h3>Press</h3>
        <ul>
          <li><a href="mailto:amir.sela@sonymusic.com">Amir Sela</a></li>
        </ul>

        <h3>Label inquires</h3>
        <ul>
          <li><a href="mailto:claes@looptrooprockers.com">Claes Uggla</a></li>
        </ul>

        <h3>Tour questions</h3>
        <ul>
          <li><a href="mailto:claes@newdirection.nu">Claes Nordin Tärby</a></li>
        </ul>
      </div>

      <div class="site-footer__social">
        <h3>Stay connected</h3>
        <ul>
          <li><a href="http://www.looptrooprockers.com/feed/">Follow the RSS feed</a></li>
          <li><a href="http://www.bloglovin.com/sv/blog/557880/looptroop-rockers">Follow us on BlogLovin'</a></li>
          <li><a href="http://twitter.com/LooptroopDVSG" rel="me">Looptroop Rockers on Twitter</a></li>
          <li><a href="http://instagram.com/looptroopdvsg" rel="me">Looptroop Rockers on Instagram</a></li>
          <li><a href="http://www.facebook.com/embeemusic" rel="me">Embee on Facebook</a></li>
          <li><a href="http://www.facebook.com/looptrooprockers" rel="me">Looptroop Rockers on Facebook</a></li>
          <li><a href="http://www.youtube.com/user/dvsgee" rel="me">Looptroop Rockers on Youtube</a></li>
        </ul>
      </div>

      <hr>

      <p>© Looptroop Rockers <?php echo date('Y') ?> | Design and development <a href="http://davidpaulsson.se/" rel="designer">David Paulsson</a> | Hosted by <a href="https://fsdata.se/">FS Data</a> | <a href="https://github.com/davidpaulsson/Looptroop-Rockers/">Want to help out, nerd?</a></p>
    </div><!-- .site-info -->
  </footer><!-- #colophon -->
</div><!-- #page -->
</div><!-- .page-wrapper -->

<?php wp_footer(); ?>

</body>
</html>
