<?php
require_once "config.php";
if (isset($_POST["page"])) {

    // Include pagination library file
    include_once "Pagination.class.php";

    // Set some useful configuration
    $baseURL = "getData.php";
    $offset = !empty($_POST["page"]) ? $_POST["page"] : 0;
    $limit = 25;

    // Set conditions for search
    $whereSQL = "";
    if (!empty($_POST["keywords"])) {
        if (strpos($_POST["keywords"], "#") === 0) {
            $idd = str_replace("#", "", $_POST["keywords"]);
            $whereSQL = " WHERE (id = $idd) ";
        } else {
            $whereSQL =
                " WHERE (id LIKE '%" .
                $_POST["keywords"] .
                "%' OR title LIKE '%" .
                $_POST["keywords"] .
                "%' OR added_allegro LIKE '%" .
                $_POST["keywords"] .
                "%') ";
        }
    }
    /*  if(isset($_POST['filterBy']) && $_POST['filterBy'] != '' && $_POST['filterBy'] != null){ 
        $whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
        $whereSQL .= " status = ".$_POST['filterBy']; 
    } 
     */
    // Count of all records
    $query_pre = "SELECT COUNT(*) as rowNum FROM products_platform" . $whereSQL;
    $query = mysqli_query($conn, $query_pre);
    $result = mysqli_fetch_assoc($query);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    $rowCount = $result["rowNum"];

    // Initialize pagination class
    $pagConfig = [
        "baseURL" => $baseURL,
        "totalRows" => $rowCount,
        "perPage" => $limit,
        "currentPage" => $offset,
        "contentDiv" => "dataContainer",
        "link_func" => "searchFilter",
    ];
    $pagination = new Pagination($pagConfig);

    // Fetch records based on the offset and limit
    $query = $conn->query(
        "SELECT * FROM products_platform $whereSQL ORDER BY id DESC LIMIT $offset,$limit"
    );
    ?> 
                <div class="loading-overlay"><div class="overlay-content">Ładowanie...</div></div>

        <?php if ($query->num_rows > 0) {
            while ($row = $query->fetch_assoc()) {
                $offset++; ?> 
            <div data-testid="listing-card-d0cacca0-4b8d-489d-803b-29658a851bad" class="sc-hrzOVh lgtHfE " id="product_id_<?php echo $row[
                "id"
            ]; ?>" style="cursor: pointer;">

                    <?php if (
                        strpos($row["added_allegro"], "allegro") !== false ||
                        strpos($row["added_olx"], "olx") !== false ||
                        strpos($row["added_erli"], "erli") !== false ||
                        strpos($row["added_alione"], "alione") !== false ||
                        strpos($row["added_sprzedajemy"], "sprzedajemy") !==
                            false ||
                        strpos($row["added_fb_marketplace"], "facebook") !==
                            false ||
                        strpos($row["added_pinterest"], "pinterest") !== false
                    ) { ?>  
                          <div data-cy="listing-card-container" class="sc-hcJkSI hmWAub vwo_product-card-sample-order added">
                            <?php } elseif ($row["need_update"] == "1") { ?>   
                             <div data-cy="listing-card-container" class="sc-hcJkSI hmWAub vwo_product-card-sample-order need_to_update">

                              <?php } else { ?>
                           <div data-cy="listing-card-container" class="sc-hcJkSI hmWAub vwo_product-card-sample-order waiting_to_add">
                            <?php } ?>

                        <div class="sc-bdxVC bpLxlG"> <div style="color: black; position: absolute;     left: 14px; top: 14px; font-size: 12px;  background: white; border-radius: 5px;  padding: 3px;">#<?php echo $row[
                            "id"
                        ]; ?></div><div data-cy="listingCardImage" class="sc-keNpes eHxGQo productt" id="<?php echo $row[
    "id"
]; ?>"  style="padding: 10px;"><img width="100%" height="100%" style="    border-radius: 20px;" src="<?php echo $row[
    "img"
]; ?>"/></div></div>
                 
                    <div class="sc-bAKPPm gbaRNO sc-iOnGvX jNbeVB"></div>
                    <div class="sc-jFdHWG iJtlpr">
                        <a  href='<?php echo $row[
                            "source_url"
                        ]; ?>' title="Przenieś do źródła" target="_blank" class="sc-cBOWjd dXzXnO">
                            <h3 title="<?php echo $row[
                                "title"
                            ]; ?>" class="sc-cmYsgE fPyFCH"><?php echo $row[
    "title"
]; ?></h3>
                        </a>
                              <?php if (
                                  strpos($row["added_allegro"], "allegro") !==
                                      false ||
                                  strpos($row["added_olx"], "olx") !== false ||
                                  strpos($row["added_erli"], "erli") !==
                                      false ||
                                  strpos($row["added_alione"], "alione") !==
                                      false ||
                                  strpos(
                                      $row["added_sprzedajemy"],
                                      "sprzedajemy"
                                  ) !== false ||
                                  strpos(
                                      $row["added_fb_marketplace"],
                                      "facebook"
                                  ) !== false ||
                                  strpos(
                                      $row["added_pinterest"],
                                      "pinterest"
                                  ) !== false
                              ) { ?>
                                 <p class="sc-ePsPkC cSWRJD">Dodane na:</p>
                                <?php } else { ?>
                                <p class="sc-ePsPkC cSWRJD" style="color: orange;">Oczekuje na dodanie</p>
                                <?php } ?>

                        <div class="sc-fejtnb dboBku">

                            <?php if (
                                strpos($row["added_allegro"], "allegro") !==
                                    false ||
                                strpos($row["added_olx"], "olx") !== false ||
                                strpos($row["added_erli"], "erli") !== false ||
                                strpos($row["added_alione"], "alione") !==
                                    false ||
                                strpos(
                                    $row["added_sprzedajemy"],
                                    "sprzedajemy"
                                ) !== false ||

                                strpos(
                                    $row["added_fb_marketplace"],
                                    "facebook"
                                ) !== false ||
                                strpos($row["added_pinterest"], "pinterest") !==
                                    false
                            ) {
                                if (
                                    strpos($row["added_allegro"], "allegro") !==
                                    false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><a href="<?php echo $row[
                                            "added_allegro"
                                        ]; ?>"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Allegro.pl_sklep.svg/1200px-Allegro.pl_sklep.svg.png" class="rectangle" /></a></div>
                                    </div>
                                    <?php }
                                if (
                                    strpos($row["added_olx"], "olx") !== false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><img src="https://www.wykop.pl/cdn/c3201142/comment_16444239007niM9IA4dAgAeGOeYIPxNp.jpg" class="rectangle" /></div>
                                    </div>
                                    <?php }
                                if (
                                    strpos($row["added_erli"], "erli") !== false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><img src="https://erli.pl/metodydostaw/assets/images/og-image.png" class="rectangle" /></div>
                                    </div>
                                    <?php }
                                if (
                                    strpos($row["added_alione"], "alione") !==
                                    false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><img src="https://alione.pl/wp-content/uploads/2022/02/alione.png" class="rectangle" /></div>
                                    </div>
                                    <?php }
                                if (
                                    strpos(
                                        $row["added_sprzedajemy"],
                                        "sprzedajemy"
                                    ) !== false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTWM8aVOl-wAggKC6xjUqBSO2I7Cc29SR3le1b42iZKY-gbaEOFnydweLbacVecVnQ2mBM&usqp=CAU" class="circle" /></div>
                                    </div>
                                    <?php }
                                if (
                                    strpos(
                                        $row["added_fb_marketplace"],
                                        "facebook"
                                    ) !== false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><img src="https://www.pinpng.com/pngs/m/557-5572338_facebook-marketplace-logo-marketplace-facebook-hd-png-download.png" class="circle" /></div>
                                    </div>
                                    <?php }
                                if (
                                    strpos(
                                        $row["added_pinterest"],
                                        "pinterest"
                                    ) !== false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><img src="https://logoeps.com/wp-content/uploads/2012/02/pinterest-icon-vector.png" class="circle" /></div>
                                    </div>
                                    <?php }
                            } else {
                                 ?>
                                   <div class="sc-kGhOqx fkLHKw">
                                        <div style="height: 35px; background: transparent;"></div>
                                    </div>
                                  <?php
                            } ?>

                        </div>

                    </div>
                             <button class="sc-efBctP kkFYhG" style="    padding-left: 18px; display: inline-flex;">
                                <div class="sc-eTFcpK ilxWoB"  style="    padding: 0px; margin-left: 0px;margin-top: -5px;">
                                    <p class="sc-kRktcz dKCUmk">Dostawa</p>
                                    <div class="sc-ejVUYw bMpfhh">
                                        <p class="sc-khBlLl flPgJW"><?php echo $row[
                                            "source_shippment_price"
                                        ]; ?> zł</p>
                                        <img src="https://sklepwind.pl/userdata/public/gfx/b736be663d442eeb587f5d13c5ba8ac6.jpg" alt="PL flag" class="country-flag" />
                                        <p class="sc-bfKFlL mlPNl"><?php echo $row[
                                            "source_shippment_time"
                                        ]; ?> dni</p>
                                        <img src="https://app.spocket.co/static/media/icon-expand-dark.c67cbf55.svg" alt="expand" class="sc-eEpejC dqHGKV" style="z-index: 9999;"/>
                                    </div>
                                </div>
                                <div class="sc-eTFcpK ilxWoB"  style="    padding: 0px; margin-left: 0px;margin-top: -5px; padding-right: 15px;">
                                    <p class="sc-kRktcz dKCUmk" style="  text-align: right;">W magazynie</p>
                                    <div class="sc-ejVUYw bMpfhh" style="float: right;">
                                        <p class="sc-khBlLl flPgJW" style="float: right;"><?php echo $row[
                                            "source_quantity"
                                        ]; ?> sztuk</p>
                                    </div>
                                </div>


                            </button>
                    <div class="sc-dPyBCJ tcXIG undefined dropdown-wrap" style="position: absolute; bottom: 0;">

                        <div style="    padding-left: 20px; padding-right: 20px;margin-bottom: -10px;">
                             <div class="sc-eQNgno hooQiq">
                                <p>Cena źródłowa</p>
                                <p>Nasza cena  </p>
                                <p style="color: transparent;">X</p>
                                <p>Zysk brutto </p>
                            </div>
                            <div class="sc-kOsxa-d iWOQkG">
                                <p class="sc-hGtivm inUgxW"><?php echo $row[
                                    "source_price"
                                ]; ?><span>zł</span></p>
                                <p class="sc-coCPJf cXsSnB"><?php echo $row[
                                    "price"
                                ]; ?><span>zł</span></p>
                                <p class="sc-coCPJf cXsSnB" style="color: #00cd00;">+ <?php echo $row[
                                    "price"
                                ] - $row["source_price"]; ?><span>zł</span></p>

                            </div>
                        </div>
                    </div>
                    <div class="sc-bcnBk bDJZpd card-button-section">
                        <div class="sc-fYHEnZ kgpauv">
                            <div class="sc-geuGuN dQUKSz">
                                <button title="Add product to import list" data-cy="add-product-to-import-list" class="sc-hKMtZM cGrIMx listing-card__add-to-import-list"><span class="add-span">+</span>Add to Import List</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sc-hcJkSI sc-jTUlZf hmWAub ehBoci vwo_product-card-sample-order-variant" data-cy="listing-card-container" style="display: none;">
                    <a title="<?php echo $row[
                        "title"
                    ]; ?>" target="_blank" rel="noopener noeferrer" data-cy="listing-card-image" href="<?php echo $row[
    "source_url"
]; ?>">
                        <div class="sc-bdxVC bpLxlG">
                         <div data-cy="listingCardImage" class="sc-keNpes eHxGQo"></div></div>
                    </a>
                    <div class="sc-bAKPPm gbaRNO sc-iOnGvX jNbeVB"></div>
                    <div class="sc-jFdHWG iJtlpr">
                        <a  href='<?php echo $row[
                            "source_url"
                        ]; ?>' title="Przenieś do źródła" target="_blank" class="sc-cBOWjd dXzXnO">
                            <h3 title="<?php echo $row[
                                "title"
                            ]; ?>" class="sc-cmYsgE fPyFCH"><?php echo $row[
    "title"
]; ?></h3>
                        </a>

                        <div class="sc-fejtnb dboBku">
                            <?php if (
                                strpos($row["added_allegro"], "allegro") !==
                                    false ||
                                strpos($row["added_olx"], "olx") !== false ||
                                strpos($row["added_erli"], "erli") !== false ||
                                strpos($row["added_alione"], "alione") !==
                                    false ||
                                strpos(
                                    $row["added_sprzedajemy"],
                                    "sprzedajemy"
                                ) !== false ||
                                strpos(
                                    $row["added_fb_marketplace"],
                                    "facebook"
                                ) !== false ||
                                strpos($row["added_pinterest"], "pinterest") !==
                                    false
                            ) {
                                if (
                                    strpos($row["added_allegro"], "allegro") !==
                                    false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><a href="<?php echo $row[
                                            "added_allegro"
                                        ]; ?>"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Allegro.pl_sklep.svg/1200px-Allegro.pl_sklep.svg.png" class="rectangle" /></a></div>
                                    </div>
                                    <?php }
                                if (
                                    strpos($row["added_olx"], "olx") !== false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><a href="<?php echo $row[
                                            "added_olx"
                                        ]; ?>"><img src="https://www.wykop.pl/cdn/c3201142/comment_16444239007niM9IA4dAgAeGOeYIPxNp.jpg" class="rectangle" /></a></div>
                                    </div>
                                    <?php }
                                if (
                                    strpos($row["added_erli"], "erli") !== false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><a href="<?php echo $row[
                                            "added_erli"
                                        ]; ?>"><img src="https://erli.pl/metodydostaw/assets/images/og-image.png" class="rectangle" /></a></div>
                                    </div>
                                    <?php }
                                if (
                                    strpos($row["added_alione"], "alione") !==
                                    false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><a href="<?php echo $row[
                                            "added_alione"
                                        ]; ?>"><img src="https://alione.pl/wp-content/uploads/2022/02/alione.png" class="rectangle" /></a></div>
                                    </div>
                                    <?php }
                                if (
                                    strpos(
                                        $row["added_sprzedajemy"],
                                        "sprzedajemy"
                                    ) !== false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTWM8aVOl-wAggKC6xjUqBSO2I7Cc29SR3le1b42iZKY-gbaEOFnydweLbacVecVnQ2mBM&usqp=CAU" class="circle" /></div>
                                    </div>
                                    <?php }
                                if (
                                    strpos(
                                        $row["added_fb_marketplace"],
                                        "facebook"
                                    ) !== false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><a href="<?php echo $row[
                                            "added_fb_marketplace"
                                        ]; ?>"><img src="https://www.pinpng.com/pngs/m/557-5572338_facebook-marketplace-logo-marketplace-facebook-hd-png-download.png" class="circle" /></a></div>
                                    </div>
                                    <?php }
                                if (
                                    strpos(
                                        $row["added_pinterest"],
                                        "pinterest"
                                    ) !== false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><a href="<?php echo $row[
                                            "added_pinterest"
                                        ]; ?>"><img src="https://logoeps.com/wp-content/uploads/2012/02/pinterest-icon-vector.png" class="circle" /></a></div>
                                    </div>
                                    <?php }
                            } else {
                                 ?>
                                   <div class="sc-kGhOqx fkLHKw">
                                        <div style="height: 35px; background: transparent;"></div>
                                    </div>
                                  <?php
                            } ?>
                        </div>
                    </div>
                             <button class="sc-efBctP kkFYhG" style="    padding-left: 15px;">
                                <div class="sc-eTFcpK ilxWoB"  style="    padding: 0px; margin-left: 0px;margin-top: -5px;">
                                    <p class="sc-kRktcz dKCUmk">Dostawa</p>
                                    <div class="sc-ejVUYw bMpfhh">
                                        <p class="sc-khBlLl flPgJW"><?php echo $row[
                                            "source_shippment_price"
                                        ]; ?> zł</p>
                                        <img src="https://app.spocket.co/static/media/US.60ed06f2.svg" alt="US flag" class="country-flag" />
                                        <p class="sc-bfKFlL mlPNl"><?php echo $row[
                                            "source_shippment_time"
                                        ]; ?> dni</p>
                                        <img src="https://app.spocket.co/static/media/icon-expand-dark.c67cbf55.svg" alt="expand" class="sc-eEpejC dqHGKV" />
                                    </div>
                                </div>
                            </button>
                    <div class="sc-dPyBCJ tcXIG undefined dropdown-wrap" style="position: absolute; bottom: 0;">

                        <div style="    padding-left: 20px; padding-right: 20px;margin-bottom: -10px;">
                             <div class="sc-eQNgno hooQiq">
                                <p>Cena źródłowa</p>
                                <p>Nasza cena  </p>
                                <p style="color: transparent;">X</p>
                                <p>Zysk brutto </p>
                            </div>
                            <div class="sc-kOsxa-d iWOQkG">
                                <p class="sc-hGtivm inUgxW"><?php echo $row[
                                    "source_price"
                                ]; ?><span>zł</span></p>
                                <p class="sc-coCPJf cXsSnB"><?php echo $row[
                                    "price"
                                ]; ?><span>zł</span></p>
                                <p class="sc-coCPJf cXsSnB" style="color: #00cd00;">+ <?php echo $row[
                                    "price"
                                ] - $row["source_price"]; ?><span>zł</span></p>

                            </div>
                        </div>
                    </div>
                    <div class="sc-cQIpJi ihJgFL vwo_product-card-sample-order-variant">
                        <div class="sc-geuGuN dQUKSz">
                            <button title="Add product to import list" data-cy="add-product-to-import-list" class="sc-hKMtZM cGrIMx listing-card__add-to-import-list"><span class="add-span">+</span>Add to Import List</button>
                        </div>
                        <button class="sc-hKMtZM lbHCNF">Order Samples</button>
                    </div>
                  </div>
                </div>
</div>
           
        <?php
            }
        } else {
            echo '<tr><td colspan="6">Niczego nie znaleziono...</td></tr>';
        } ?> 

     
    <!-- Display pagination links --> 
    <?php echo $pagination->createLinks(); ?> 
<?php
}
?>
