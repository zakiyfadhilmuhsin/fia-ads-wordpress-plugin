<!------------------------------->
<!-- Option Page HTML Template -->
<!------------------------------->
<style type="text/css">
.bg-page {
    background-color: white;
    padding: 20px 30px;
    margin: 20px 0 0 0;
    border: 1px solid #c1c1c1;
    border-radius: 5px;
    max-width: 70%;
}
.page-title {
    font-size: 28px;
    font-weight: bold;
    margin-left: 10px;
}
.page-description {
    font-size: 14px;
    font-weight: 600;
}
.flex-wrapper {
    display: flex;
    align-items: center;
    margin-bottom: -20px;
}
</style>

<div class="bg-page">
    <div class="flex-wrapper">
        <img src="https://cdns.iconmonstr.com/wp-content/assets/preview/2017/240/iconmonstr-facebook-6.png" width="32" />  
        <h1 class="page-title">Facebook Instant Articles (Custom Ads)</h1>
    </div>
    <h4 class="page-description">Plugin untuk mengenerate xml untuk kebutuhan fb instant articles</h4>
    <hr style="margin-bottom: 30px" />
    <form method="POST" action="options.php">
        <?php
            // display settings field on theme-option page
            settings_fields("fia-ads-options");

            // display all sections for theme-options page
            do_settings_sections("fia-custom-ads-options");
            submit_button();
        ?>
    </form>
</div>