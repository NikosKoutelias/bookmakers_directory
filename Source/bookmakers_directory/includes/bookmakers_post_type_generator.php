<?php

add_action('admin_menu', 'adminPage');

function adminPage()
{
    add_menu_page('Bookmakers Shortcode Generator', 'Bookmakers Shortcode', 'manage_options', 'shortcode_generator', 'adminHTML');
}

function adminHTML()
{
    $data = rest_data();
    $validate_data = valid($data);
    unset($data)
?>

    <div class="flex-wrap col-12 all_meta">
        <h1>Bookmakers Generator</h1>
        <form action="" method="">

            <div class=" form-group col-8">
                <label for="results_short" class="lead"><strong>Αποτελέσματα Shortcode</strong></label>
                <input class="form-control" id="results" type="text" name="results_short" value="[bookmakers_directory_short layout='' sort_by='' sorting_id='' cta='' limit='' title='']">
            </div>

            <div class=" form-group col-3">
                <label for="title_short" class="lead"><strong>Title</strong></label>
                <input class="form-control " type="text" name="title_short" data-attribute="title" id="title" placeholder="Επιθυμητός Τίτλος">
            </div>

            <div class="form-group col-1">
                <label for="limit_short" class="h5">Limit</label>
                <input class="form-control " id="limit" type="text" name="limit_short" data-attribute="limit" placeholder="Όριο">
            </div>

            <div class="form-group col-1  ">
                <label for="cta" class="h5">Ctas</label>
                <select name="cta" class="form-select" id="cta" data-attribute="cta">
                    <option disabled>Κάνε μια επιλογή</option>
                    <option selected value="Παίξε Νόμιμα">Παίξε Νόμιμα</option>
                    <option value="Εγγραφή">Εγγραφή</option>
                </select>
            </div>

            <div class="form-group col-1  ">
                <label for="layout" class="h5">Layouts</label>
                <select name="layout" class="form-select" id="layout" data-attribute="layout">
                    <option disabled>Κάνε μια επιλογή</option>
                    <option selected value="sidebar">Sidebar</option>
                    <option value="card-layout">Κάρτες 4αδες</option>
                </select>
            </div>



            <div class="form-group col-6  ">
                <label for="sort_by" class="h5">Sort By</label>
                <select name="sort_by" id="sort_by" class="form-select" data-attribute="sort_by">

                    <option disabled>Επιλογή συγκεκριμένης βαθμολογίας</option>
                    <option selected value="bk_final_score">Επιλογή Συνολικής Βαθμολογίας</option>
                    <option value="bk_cs1">Αγορές</option>
                    <option value="bk_cs2">Αποδόσεις</option>
                    <option value="bk_cs3">Mobile</option>
                    <option value="bk_cs4">Πλατφόρμα</option>
                    <option value="bk_cs5">Live Streaming</option>
                    <option value="bk_cs6">Προϊόντα - Υπηρεσίες</option>
                </select>

                <label for="order_by" class="h5">Order By</label>

                <select name="order_by" id="order_by" class="form-select">
                    <option disabled selected>Κάνε μια επιλογή</option>
                    <option selected value="ASC">ASC</option>
                    <option value="DESC">DESC</option>
                </select>
            </div>

            <div class="form-group col-6  ">
                <label for="sorting_id" class="h5">Sorting by ID</label>
                <input type="checkbox" id="sorting_id" name="sorting_id" data-toggle="collapse" data-target="#collapse_panel" value="">

                <div id="collapse_panel" class="collapse mt-6">

                    <ul id="sortlist" data-attribute="sorting_id" style="list-style-type: none; margin: 0; padding: 0; width: 60%;">
                        <?php
                        foreach ($validate_data as $key => $row) {

                        ?>

                            <li class="ui-state-default " data-id="<?php echo $row["ID"] ?>"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                <?php

                                echo $row["post_title"];

                                ?>
                            </li>
                        <?php } ?>
                    </ul>

                </div>
            </div>


        </form>
    </div>

<?php
}
