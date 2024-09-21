<?php
include_once './php/db_connect.php';

$conn = getDatabaseConnection();
// Fetch products with discount = 1
$discounted_products = [];
$stmt = $conn->prepare("SELECT products_id, title, price, images FROM products WHERE discount = ? LIMIT 3");
if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
}

$discount = 1; // Set discount value
$stmt->bind_param("i", $discount);
$stmt->execute();
$result = $stmt->get_result();

$discounted_products = [];
while ($row = $result->fetch_assoc()) {
        $discounted_products[] = $row;
}

$stmt->close();
$conn->close();
?>

<style>
        .repair-container {
                padding: 100px 0;
        }

        .col-sm-9 {
                flex: 0 0 75%;
                max-width: 75%;
        }

        .col-sm-3 {
                flex: 0 0 25%;
                max-width: 25%;
        }
</style>

<?php include("navbar.php"); ?>

<div class="repair-container">
        <div class="row">
                <div class="col-sm-9 col-12" style="padding-right: 15px;">
                        <h1 class="page_title mt-2 mb-2">Sửa chữa</h1>
                        <h6 class="detail-new-teaser text-justify"> <strong>Dịch vụ cơ bản sửa chữa, thay thế
                                        máy ảnh và một
                                        số lưu ý khi sử dụng và sửa máy ảnh tại PROCAM
                                </strong> </h6>
                        <p></p>
                        <p><span style="color: rgb(64, 64, 64); font-size: 14px;">Chúng
                                        ta đang sống trong thời đại công nghệ số không ngừng phát triển mạnh mẽ
                                        với những sản phẩm
                                        công
                                        nghệ rất đa dạng. Trong số đó, máy ảnh, máy quay kỹ thuật số là một
                                        trong những sản phẩm
                                        ngày
                                        càng trở lên gần gũi, gắn bó với nhu cầu cuộc sống hàng ngày. Hầu hết
                                        trong số chúng ta
                                        đều
                                        mong muốn sở hữu chiếc máy ảnh, máy quay "đẳng cấp" và có độ ổn định
                                        cao. Tuy nhiên, trong
                                        quá
                                        trình sử dụng, sẽ rất khó tránh khỏi những trường hợp hỏng hóc do lỗi
                                        sản xuất không thể
                                        tránh
                                        khỏi, do bảo quản không đúng cách, do tại nạn ngoài ý muốn.</span></p>
                        <div class="f-news-view-detail"
                                style="box-sizing: border-box; color: rgb(64, 64, 64); font-size: 13px; line-height: 21px;">
                                <p
                                        style="box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; text-align: center;">
                                        <span style="box-sizing: border-box; font-size: 14px;"><img alt=""
                                                        src="./uploads/img/canon/200D/200D.png"
                                                        style="box-sizing: border-box; border: none; vertical-align: middle; margin: 0px; padding: 0px;"
                                                        width="500" height="334"></span>
                                </p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;">Với đội
                                                ngũ kỹ thuật viên được đào tạo
                                                chuyên sâu, kinh nghiệm lâu năm trong ngành, cùng với tác phong
                                                làm việc chuyên
                                                nghiệp, chúng tôi tự hào có thể sửa chữa mọi hư hỏng cho chiếc
                                                máy ảnh, máy quay phim kỹ
                                                thuật số thân yêu của bạn.</span></p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;">Đến với
                                                trung tâm sửa
                                                chữa máy
                                                ảnh, bạn
                                                có thể hoàn toàn yên tâm gửi chiếc máy ảnh, máy quay của mình
                                                vào sửa chữa vì chúng
                                                tôi
                                                có quy trình nhận và sửa máy chuyên nghiệp, khoa học. Thông tin
                                                của khách sẽ được lưu
                                                giữ
                                                trên hệ thống nhằm hỗ trợ tốt hơn sau sửa chữa &amp; sau bán
                                                hàng. Đồng thời, chúng tôi
                                                cam
                                                kết các linh kiện, phụ kiện trên chiếc máy ảnh, máy quay phim
                                                của bạn sẽ được bảo vệ,
                                                chăm
                                                sóc cẩn thận,<span
                                                        style="box-sizing: border-box; font-weight: bolder;">
                                                </span>lựa
                                                chọn phương pháp sửa chữa, thay thế phù hợp nhất với mức giá
                                                tiết kiệm nhất.</span></p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;">PROCAM
                                                cam kết tất cả những linh
                                                kiện,
                                                phụ kiện khi thay thế cho khách hàng là những sản phẩm chính
                                                hãng chất lượng tốt nhất.
                                                Tất
                                                cả những máy ảnh, máy quay được sửa chữa ra đều được qua khâu
                                                kiểm tra, thẩm định chất
                                                lượng. Do đó, những máy ảnh, máy quay sau khi sửa chữa có độ ổn
                                                định cao. Vì
                                                vậy, Quý khách hàng sẽ hoàn toàn yên tâm khi gửi máy sửa chữa
                                                tại PROCAM.</span>
                                </p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;"><span
                                                        style="box-sizing: border-box; font-weight: bolder;">Điểm
                                                        khác biệt lớn nhất khi sửa
                                                        chữa máy ảnh, máy quay phim tại PROCAM là thời gian sửa
                                                        chữa cực nhanh vì với
                                                        đội
                                                        ngũ kỹ thuật viên tay nghề cao, nguồn linh kiện, phụ
                                                        kiện dồi dào, sửa chữa, thay
                                                        thế
                                                        tại chỗ. Quý khách có thể ngồi tại chỗ thưởng thức cà
                                                        phê và quan sát chúng tôi
                                                        chăm sóc chiếc máy ảnh, máy quay phim của mình</span>.
                                                Những trường hợp linh kiện
                                                hiếm
                                                hoặc không có linh kiện thay thế, PROCAM sẽ thông cụ thể, chi
                                                tiết và trong
                                                thời
                                                gian sớm nhất.</span></p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;"><span
                                                        style="box-sizing: border-box; font-weight: bolder;">Giá
                                                        dịch vụ sửa chữa tại PROCAM đảm bảo tốt nhất thị trường
                                                </span>nhờ yếu tố con
                                                người và khả năng tài
                                                chính. Đó là nguồn linh kiện, phụ kiện dồi dào, đội ngũ kỹ thuật
                                                viên có trình độ, tay
                                                nghề
                                                cao và nhiều kinh nghiệm sửa chữa tại chỗ. <span
                                                        style="box-sizing: border-box; font-weight: bolder;">Hiện
                                                        nay một số đơn vị khác họ
                                                        chỉ
                                                        nhận máy của khách có nhu sầu sửa chữa và mang đến chỗ
                                                        khác để sửa và kê thêm chi
                                                        phí
                                                        nên giá sửa cao và không được đảm bảo.</span></span></p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;">Tất cả
                                                máy ảnh, máy quay phim... được
                                                sửa
                                                chữa tại PROCAM đều được bảo hành từ 3 tháng đến một năm cho nội
                                                dung được sửa
                                                chữa, với lỗi đã khắc phục, trong thời gian bảo hành lỗi đã sửa
                                                được xử lí miễn
                                                phí.</span></p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;"> PROCAM
                                                áp dụng chế độ hỗ trợ
                                                cho
                                                khách hàng mượn máy khác để sử dụng nếu sản phẩm của khách hàng
                                                mua tại PROCAM bị
                                                hư
                                                hỏng đang trong thời gian bảo hành, sửa chữa...</span></p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;"><span
                                                        style="box-sizing: border-box; font-weight: bolder;">PROCAM
                                                        khẳng định luôn
                                                        trung
                                                        thực, thông báo đúng tình trạng và những hư hỏng của
                                                        máy, báo giá đầy
                                                        đủ dịch
                                                        vụ sửa chữa</span> máy ảnh, máy quay. Đồng thời, <span
                                                        style="box-sizing: border-box; font-weight: bolder;">cung
                                                        cấp hóa đơn sửa chữa, thay
                                                        thế</span> (nếu cần).</span></p>
                                <p class="f-new-view-detail-content"> </p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;"><span
                                                        style="box-sizing: border-box; font-weight: bolder;">Một
                                                        số dịch vụ cơ bản sửa chữa,
                                                        thay thế:</span></span></p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;">- Thay
                                                màn hình máy ảnh các loại</span>
                                </p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;">- Lau
                                                mốc, rễ tre, vệ sinh các loại ống
                                                kính máy ảnh</span></p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;">- Khắc
                                                phục lỗi đứt dây khẩu ống
                                                kính</span></p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;">- Khắc
                                                phục lỗi chân cắm thẻ CF của máy
                                                ảnh
                                                DSLR</span></p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;">- Khắc
                                                phục lỗi ống kính, lỗi main, lỗi
                                                đèn
                                                flash</span></p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;">- Thay
                                                cáp màn hình máy ảnh các
                                                loại</span>
                                </p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;">- Thay
                                                cáp cơ máy quay</span></p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;">- Thay
                                                sensor, gương lật máy ảnh
                                                DSLR</span></p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;">- Khắc
                                                phục các lỗi máy ảnh DSLR
                                                (Nikon,
                                                Canon...)</span></p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;"><span
                                                        style="box-sizing: border-box; font-weight: bolder;">-
                                                        Khám bệnh máy ảnh miễn
                                                        phí</span></span></p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;">- Tư vấn
                                                tự khắc phục lỗi cơ bản, khắc
                                                phục
                                                tạm thời các lỗi của máy ảnh DSLR miễn phí</span></p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;">Dịch vụ
                                                sửa chữa máy
                                                ảnh số,
                                                máy ảnh chuyên nghiệp, uy tín, giá rẻ nhất</span></p>
                                <p class="f-new-view-detail-content"> </p>
                                <div
                                        style="box-sizing: border-box; margin: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 252, 252); text-align: center;">
                                        <span style="box-sizing: border-box; font-size: 14px;"><img alt=""
                                                        src="./uploads/img/banner1.jpg"
                                                        style="box-sizing: border-box; border: none; vertical-align: middle; height: 200px; margin: 0px; padding: 0px; width: 524px;"></span>
                                </div>
                                <div
                                        style="box-sizing: border-box; margin: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 252, 252);">
                                        <p class="f-new-view-detail-content">
                                        </p>
                                </div>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;"><span
                                                        style="box-sizing: border-box; font-weight: bolder;">Một
                                                        số lưu ý khi sử dụng
                                                        và sửa máy ảnh</span></span></p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;">- Máy
                                                ảnh rất ít khi tự hỏng bởi nó ít
                                                phần
                                                mềm bên trong, máy ảnh chủ yếu bị hỏng do sử dụng không đúng
                                                cách và bảo quản không đúng
                                                cách. </span></p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;">- Khí
                                                hậu nước ta là nhiệt đới nóng ẩm,
                                                dễ
                                                bị ẩm mốc nên: cần có tủ bảo quản hoặc thỉnh thoảng mang máy ảnh
                                                ra phơi nửa tiếng dưới
                                                trời
                                                nắng. </span></p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;">- Địa
                                                chỉ sửa chữa (ngoài những trung
                                                tâm
                                                bảo hành chính hãng): có rất nhiều địa chỉ nhưng chưa có một
                                                tiêu chuẩn, qui trình
                                                chung,
                                                chất lượng cũng chưa có sự kiểm định chính xác. Tham khảo, tìm
                                                hiểu kĩ nơi có ý định đến
                                                sửa, có nhiều cửa hàng bị lên án về việc om máy, luộc đồ. Nhiều
                                                cửa hàng chỉ là trung
                                                gian
                                                nhận máy và chuyển nơi khác sửa chữa để ăn chênh lệch, do đó bạn
                                                chỉ nên sửa khi tận mắt
                                                nhìn thấy phòng máy và thợ sửa máy. </span></p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;">- Giá
                                                sửa chữa, thời gian sửa chữa,
                                                linh
                                                kiện thay thế mỗi nơi cũng khác nhau. Nếu hỏi giá sửa chữa thì
                                                nhiều cửa hàng không nói
                                                khoảng bao nhiêu được, họ nói cần mang cụ thể máy đó đến, kiểm
                                                tra và tùy tình trạng
                                                cũng
                                                như khả năng có đồ thay thế khi đó mới có giá cụ thể. Nhiều nơi
                                                lợi dụng việc này để ép
                                                khách thay thế linh kiện và nâng giá sửa chữa, đặt khách vào
                                                tình huống "đã đâm lao phải
                                                theo lao". Giá máy ảnh hiện nay rất rẻ, nên nếu máy bị lỗi hỏng
                                                nặng phải thay thế đắt
                                                tiền
                                                thì bạn nên cân nhắc việc mua máy mới. </span></p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;">- Khi đi
                                                sửa máy, cần yêu cầu cửa hàng
                                                có
                                                xác nhận tình trạng máy trước khi sửa chữa, ký tên vào các bộ
                                                phận linh kiện bên trong
                                                nếu
                                                máy bị lỗi phải bổ máy, thay thế linh kiện. </span></p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;">- Có
                                                thỏa thuận bảo hành sau sửa
                                                chữa. </span></p>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;">- Nên
                                                đến những địa chỉ sửa chữa, bảo
                                                hành
                                                chính hãng vì ở đó có qui trình sửa chữa cụ thể, chuyên
                                                nghiệp.</span></p>
                                <div
                                        style="box-sizing: border-box; margin: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 252, 252);">
                                        <p class="f-new-view-detail-content">
                                                <span style="box-sizing: border-box; font-size: 14px;"><span
                                                                style="box-sizing: border-box; font-family: tahoma, geneva, sans-serif;"><span
                                                                        style="box-sizing: border-box; font-weight: bolder;">Trung
                                                                        Tâm Bảo Hành -
                                                                        Sửa Chữa Máy Ảnh
                                                                        PROCAM</span></span></span>
                                        </p>
                                        <div class="bg_white relative"
                                                style="box-sizing: border-box; margin: 0px; padding: 0px; position: relative; line-height: 18.6px;">
                                                <div class="bg_lienhe"
                                                        style="box-sizing: border-box; margin: 0px; padding: 15px;">
                                                        <div
                                                                style="box-sizing: border-box; margin: 0px; padding: 0px;">
                                                                <p class="f-new-view-detail-content">
                                                                        <span
                                                                                style="box-sizing: border-box; font-size: 14px;"><span
                                                                                        style="box-sizing: border-box; color: rgb(0, 0, 0);"><span
                                                                                                style="box-sizing: border-box; font-weight: bolder;"><img
                                                                                                        alt=""
                                                                                                        src="./uploads/img/ProCam.png"
                                                                                                        style="box-sizing: border-box; border: none; vertical-align: middle; float: left; width: 150px;height: 90px; margin: 30px 15px; padding: 0px; ">
                                                                                                PROCAM -
                                                                                                Prfessional
                                                                                                Camera &amp;
                                                                                                Accessories</span></span></span>
                                                                </p>
                                                                <p class="f-new-view-detail-content">
                                                                        <span
                                                                                style="box-sizing: border-box; font-size: 14px;"><span
                                                                                        style="box-sizing: border-box; color: rgb(0, 0, 0);"><span
                                                                                                style="box-sizing: border-box; font-weight: bolder;">
                                                                                        </span>Công Ty TNHH
                                                                                        PROCAM (PROCAMa Co.,
                                                                                        Ltd)
                                                                                </span></span>
                                                                </p>
                                                                <p class="f-new-view-detail-content">
                                                                        <span
                                                                                style="box-sizing: border-box; font-size: 14px;"><span
                                                                                        style="box-sizing: border-box; color: rgb(0, 0, 0);">
                                                                                        70 Tô ký, Quận
                                                                                        12, TP.HCM</span></span>
                                                                </p>
                                                                <p class="f-new-view-detail-content">
                                                                        <span
                                                                                style="box-sizing: border-box; font-size: 14px;"><span
                                                                                        style="box-sizing: border-box; color: rgb(0, 0, 0);">
                                                                                        Điện
                                                                                        thoại<span
                                                                                                style="box-sizing: border-box; color: rgb(64, 64, 64);">:
                                                                                                999 999 999 -
                                                                                                Hotline: 999 999 999 - 999 999 999</span></span></span>
                                                                </p>
                                                                <p class="f-new-view-detail-content">
                                                                        <span
                                                                                style="box-sizing: border-box; font-size: 14px;"><span
                                                                                        style="box-sizing: border-box; color: rgb(0, 0, 0);">
                                                                                        <span
                                                                                                style="box-sizing: border-box; color: rgb(64, 64, 64);">Phòng
                                                                                                Kỹ
                                                                                                Thuật &amp; Sửa
                                                                                                chữa: 999 999 999</span></span></span>
                                                                </p>
                                                                <p class="f-new-view-detail-content">
                                                                        <span
                                                                                style="box-sizing: border-box; font-size: 14px;"><span
                                                                                        style="box-sizing: border-box; color: rgb(0, 0, 0);">
                                                                                        Email: kqtt@gmail.com
                                                                                        - Website:
                                                                                        www.kqtcamera.vn</span></span>
                                                                </p>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>

                </div>
                <div class="col-sm-3 col-12">
                        <div class="block-product-item">
                                <h3 class="page_title text-center">Sản phẩm nổi bật</h3>
                                <?php if (!empty($discounted_products)): ?>
                                        <?php foreach ($discounted_products as $product): ?>
                                                <div class="item"> <a href="product.php?id=<?php echo $product['products_id']; ?>" style="text-decoration: none;">
                                                </div>
                                                <div class="content" style=" background-color: burlywood;">
                                                        <div class="img" style="text-align: center; color: black; ">
                                                                <img src="./uploads/<?php echo $product['images'] ?>" alt="<?php echo htmlspecialchars($product['title']); ?>"
                                                                        class="img-responsive " style="width: 100%;  ">
                                                                <label class="productPrice" style="font-style:bole; font-size:30px"><?php echo htmlspecialchars($product['title']); ?></label>
                                                                <p class="productPrice" style="font-size:20px">Giá từ: <strong><?php echo number_format($product['price'], 0, ',', '.'); ?>đ </strong> </p>
                                                        </div>
                                                        </a>
                                                </div>
                                        <?php endforeach; ?>
                                <?php else: ?>
                                        <p>Không có sản phẩm nào có giảm giá.</p>
                                <?php endif; ?>
                        </div>
                </div>
        </div>


        <!-- footer  -->
        <?php include("footer.php"); ?>