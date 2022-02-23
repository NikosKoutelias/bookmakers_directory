<?php

add_action('admin_menu', 'adminPage');

function adminPage()
{

    add_menu_page('Bookmakers Shortcode Generator', 'Bookmakers Shortcode', 'manage_options', 'shortcode_generator', 'adminHTML');
}

function adminHTML()
{
    // wp_enqueue_script('bookers_helpers');
    $data = rest_data();
    $validate_data = valid($data);
    unset($data);
    wp_enqueue_script('bookers_helpers');
?>
    <style>
        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        .collapse1 {
            display: block;
            max-height: 0px;
            overflow: hidden;
            transition: max-height 0.5s cubic-bezier(0, 1, 0, 1);
        }

        .collapse1.show {
            max-height: 99em;
            transition: max-height 2s ease-in-out;
        }

        .w-100 {
            width: 100%;
        }

        .w-50 {
            width: 50%;
        }

        .w-25 {
            width: 25%;
        }

        .d-flex {
            display: flex;
        }

        .flex-wrap {
            flex-wrap: wrap;
        }

        .form-control {
            display: block;
            width: 100%;
            height: 0.3rem;
            padding: 0.75rem
        }

        .form-group {
            display: flex;
            flex: 0 0 auto;
            flex-flow: row wrap;
            align-items: center;
            margin-bottom: 0;
        }

        .lead {
            font-weight: 600;
            font-size: 0.9375rem;

        }

        .m-1 {
            margin: 0.3125rem;
        }

        .m-2 {
            margin: 0.6250rem;
        }

        .m-3 {
            margin: 1.2500rem;
        }

        .mt-1 {
            margin-top: 0.3125rem;
        }

        .h5 {
            font-size: 1.125rem;
            font-weight: 600;
        }

        .control {
            padding: 0.50rem;
            padding-left: 0;
            margin: 0.75rem;
            margin-left: 0;
            display: block;



        }
    </style>

    <script>
        document.addEventListener("change", function(event) {
            if (event.target.classList.contains("trigger")) {
                document.getElementById("collapse_panel").classList.toggle("show");
            }
        });
    </script>



    <div class="flex-wrap d-flex w-50 all_meta">
        <h1>Bookmakers Generator</h1>
        <form class="w-100">

            <div class=" form-group">
                <label for="results_short" class="lead m-1">Αποτελέσματα Shortcode</label>
                <input class="form-control m-1" id="results" type="text" name="results_short" value="[bookmakers_directory_short layout='' sort_by='' sorting_id='' cta='' limit='' title='']">
            </div>

            <div class=" form-group ">
                <label for="title_short" class="h5 m-1">Title</label>
                <input class="form-control m-1" type="text" name="title_short" data-attribute="title" id="title" placeholder="Επιθυμητός Τίτλος">
            </div>

            <div class="form-group">
                <label for="limit_short" class="h5 m-1">Limit</label>
                <input class="form-control m-1" id="limit" type="text" name="limit_short" data-attribute="limit" placeholder="Όριο">
            </div>

            <div class="form-group">
                <label for="cta" class="h5 m-1">Ctas</label>
                <select name="cta" class="form-select m-1" id="cta" data-attribute="cta">
                    <option disabled>Κάνε μια επιλογή</option>
                    <option selected value="Παίξε Νόμιμα">Παίξε Νόμιμα</option>
                    <option value="Εγγραφή">Εγγραφή</option>
                </select>
            </div>

            <div class="form-group">
                <label for="layout" class="h5 m-1">Layouts</label>
                <select name="layout" class="form-select m-1" id="layout" data-attribute="layout">
                    <option disabled>Κάνε μια επιλογή</option>
                    <option selected value="sidebar">Sidebar</option>
                    <option value="card-layout">Κάρτες 4αδες</option>
                </select>
            </div>



            <div class="form-group">
                <label for="sort_by" class="h5 m-1">Sort By</label>
                <select name="sort_by" id="sort_by" class="form-select m-1" data-attribute="sort_by">

                    <option disabled>Επιλογή συγκεκριμένης βαθμολογίας</option>
                    <option selected value="bk_final_score">Επιλογή Συνολικής Βαθμολογίας</option>
                    <option value="bk_cs1">Αγορές</option>
                    <option value="bk_cs2">Αποδόσεις</option>
                    <option value="bk_cs3">Mobile</option>
                    <option value="bk_cs4">Πλατφόρμα</option>
                    <option value="bk_cs5">Live Streaming</option>
                    <option value="bk_cs6">Προϊόντα - Υπηρεσίες</option>
                </select>

                <label for="order_by" class="h5 m-1">Order By</label>

                <select name="order_by" id="order_by" class="form-select m-1">
                    <option disabled selected>Κάνε μια επιλογή</option>
                    <option selected value="ASC">ASC</option>
                    <option value="DESC">DESC</option>
                </select>
            </div>

            <div class="control w-25">
                <label for="sorting_id" class="h5 m-1 mt-1">Sorting by ID</label>
                <input type="checkbox" class="trigger m-2 mt-1" id="sorting_id" name="sorting_id" data-toggle="collapse1" data-target="#collapse_panel" value="">
            </div>

            <div class="block collapse1 m-3" id="collapse_panel">

                <ul id="sortlist" data-attribute="sorting_id" style="list-style-type: none; margin: 0; padding: 0; width: 40%; ">
                    <?php
                    foreach ($validate_data as $key => $row) {

                    ?>

                        <li class="ui-state-default m-2 " style="font-size: 15px; font-weight:500;" data-id="<?php echo $row["ID"] ?>"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
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
