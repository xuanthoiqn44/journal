
<div class="_completed_order">
    <div class="_ct">
        <label>Topic:</label>
        <div class="_order-summary">
        <h5 id="topic"></h5>
        </div>
    </div>
    <div class="_ct">
        <label>Type of paper:</label>
        <div class="_order-summary">
            <p id="type_of_paper"></p>
        </div>
    </div>
    <div class="_ct">
        <label>Subject area:</label>
        <div class="_order-summary">
            <p id="subject_area"></p>
        </div>
    </div>
    <div class="_ct">
        <label>Tổng số trang :</label>
        <div class=" _order-summary">
            <p id="_page-of-file"><?= $model->number_of_page ?></p>
        </div>
    </div>
    <div class="_ct">
        <label>Basic price:</label>
        <div class="_order-summary">
            <p>0</p>
        </div>
    </div>
    <div class="_ct">
        <label>Writer level: Best available</label>
        <div class=" _order-summary">
            <p id="_id-writer-level"><?= $model->type_of_paper ?></p>
        </div>
    </div>
    <div class="_ct">
        <label>Customer service: Basic </label>
        <div class=" _order-summary">
            <p id="_id-customer-service"><?= $model->type_of_paper ?></p>
        </div>
    </div>
    <div class="_ct">
        <label>Language style: US writer</label>
        <div class=" _order-summary">
            <p>$0.00</p>
        </div>
    </div>

    <div class="_ct">
        <div class="_title">
            <label>Toltal Prices:</label>
        </div>
        <div class="_total-prices">
            <span><?= $model->total_prices ?></span>
        </div>
    </div>
</div>