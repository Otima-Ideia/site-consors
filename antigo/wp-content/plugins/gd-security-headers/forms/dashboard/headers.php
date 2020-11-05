<div class="d4p-group d4p-group-dashboard-card d4p-group-dashboard-basic">
    <h3><?php _e("Security Headers", "gd-security-headers"); ?></h3>
    <div class="d4p-group-stats">
        <ul class="gdsih-headers-overview">
            <li>
                <a href="admin.php?page=gd-security-headers-settings&panel=global"><strong><i class="fa fa-file-code-o fa-fw"></i> <?php _e(".HTACCESS", "gd-security-headers"); ?></strong></a>
                <?php if (gdsih_settings()->get('htaccess_added', 'core')) { ?>
                    <span class="ssl" style="background: #008800"><?php _e("Added", "gd-security-headers"); ?></span>
                <?php } else { ?>
                    <span class="ssl" style="background: #880000"><?php _e("Not Used", "gd-security-headers"); ?></span>
                <?php } ?>
                <?php if (gdsih_settings()->get('htaccess_available', 'core')) { ?>
                    <span class="ssl" style="background: #ec750c"><?php _e("Available", "gd-security-headers"); ?></span>
                <?php } else { ?>
                    <span class="ssl" style="background: #000088"><?php _e("Not Available", "gd-security-headers"); ?></span>
                <?php } ?>
            </li>

            <?php

                $_data = gdsih_statistics()->headers();

                foreach ($_data as $header) {

                    ?><li><a href="<?php echo $header['url']; ?>">
                        <strong><i class="fa fa-<?php echo $header['icon']; ?> fa-fw"></i> <?php echo $header['label']; ?></strong>
                    </a>
                    <?php if ($header['status']) { ?>
                        <span class="active" style="background: #008800"><?php _e("Active", "gd-security-headers"); ?></span>
                        <?php if (isset($header['csp'])) { ?>
                            <?php if ($header['report']) { ?>
                                <span class="report" style="background: #484848"><?php _e("Report Mode", "gd-security-headers"); ?></span>
                            <?php } ?>
                            <?php if ($header['live']) { ?>
                                <span class="report" style="background: #ec750c"><?php _e("Live Mode", "gd-security-headers"); ?></span>
                            <?php } ?>
                        <?php } ?>
                    <?php } else { ?>
                        <span class="disabled" style="background: #880000"><?php _e("Disabled", "gd-security-headers"); ?></span>
                    <?php } ?>
                    <?php if ($header['recommended']) { ?>
                        <span class="recommended" style="background: #000088"><?php _e("Recommended", "gd-security-headers"); ?></span>
                    <?php } ?><?php if (isset($header['ssl']) && $header['ssl']) { ?>
                        <span class="ssl" style="background: #ec750c"><?php _e("SSL Recommended", "gd-security-headers"); ?></span>
                    <?php } ?>
                    </li><?php

                }

            ?>

        </ul><div class="d4p-clearfix"></div>
    </div>
    <div class="d4p-group-inner">
        <h4><?php _e("HTTP Headers Security Recommendation", "gd-security-headers"); ?></h4>

        <p>
            <?php _e("Here are few recommendations to improve your website and your website users security.", "gd-security-headers"); ?>
        </p>

        <ul class="gdsih-list-rec">
            <li><?php _e("Check out the list of available HTTP headers and enable and configure all the headers that are recommended.", "gd-security-headers"); ?></li>
            <?php if (gdsih_settings()->get('mode', 'csp') == 'report') { ?>
                <li><?php _e("Content Security Policy is currently configured as 'Report Only'. Make sure to switch it to 'Live Mode' once you set it up.", "gd-security-headers"); ?></li>
            <?php } ?>
            <?php if (!is_ssl()) { ?>
                <li><?php _e("You should use HTTPS everywhere on your website. For that, you need to configure valid and trusted SSL certificate on your server.", "gd-security-headers"); ?></li>
            <?php } ?>
            <li><?php _e("Make sure to keep your website updated so that all core security updates are applied.", "gd-security-headers"); ?></li>
        </ul>
        <h4><?php _e("Apache HTACCESS", "gd-security-headers"); ?></h4>

        <p>
            <?php _e("To use headers via HTACCESS on Apache servers (or in Apache config), make sure that Apache module MOD_HEADERS is enabled.", "gd-security-headers"); ?>
        </p>
    </div>
    <div class="d4p-group-footer">
        <a href="admin.php?page=gd-security-headers-settings" class="button-primary"><?php _e("Plugin Settings", "gd-security-headers"); ?></a>
        <a href="admin.php?page=gd-security-headers-headers" class="button-primary"><?php _e("Generated Headers", "gd-security-headers"); ?></a>
    </div>
</div>