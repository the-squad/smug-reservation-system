<div role="tabpanel" class="tab-pane unactive" id="tables">
    <div class="tables-view" id="admin-view" onmousedown="div_mouse_down(this, event)">
        <?php  foreach ($data['tables'] as $table): ?>
        <div id="tb<?=$table['id']?>" class="table-info existing-table" style="top: <?=$table['x']?>%; left: <?=$table['y']?>%;">
                <input type="radio" table-number="<?=$table['table_number']?>" name="table-icon[]" id="t<?=$table['id']?>" class="table-box"/>
                <label for="t<?=$table['id']?>"></label>
                <div class="info" for="t<?=$table['id']?>">
                    <label for="t<?=$table['id']?>">
                        <strong><span id="number">Table <?=$table['table_number']?></span></strong>
                        <br />
                        <span id="seats"><?=$table['chairs_number']?> Seats</span></label>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- Taking tables input -->
    <form name="tables_info" id="tables_form">
        <div class="input-layout half-input">
            <input type="number" max="2" id="tableNumber">
            <label>Table number</label>
        </div>
        <div class="input-layout half-input-up">
            <select id="tableSeats">
                <option>2</option>
                <option>4</option>
                <option>6</option>
            </select>
            <label>Seats Number</label>
        </div>
    </form>

    <!-- Alert message starts -->
    <div class="alert alert-danger alert-dismissible col-md-6 col-md-offset-3 col-xs-10 col-xs-offset-1 text-center" role="alert" id="table-alert">
        <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Error,</strong> This table is alreay reserved
    </div>

    <!-- Floating buttons starts -->
    <button class="filled tables-buttons" id="add-table-button" onclick="controlTable(this.id);">Add Table</button>
    <button class="filled tables-buttons" id="update-table-button" onclick="controlTable(this.id);">Update Table</button>
    <button class="filled tables-buttons" id="save-table-button" >Save Table</button>
    <button class="filled tables-buttons" id="delete-table-button">Delete Table</button>
</div>
