<?php
include_once './php/db_connect.php';

?>

<style>
    .contact {
        background-color: #fff;
        padding: 100px 0;
    }

    .contact-container {
        display: flex;
        justify-content: space-between;
        margin: 0 auto;
        max-width: 1000px;
        gap: 10px;
        border-radius: 10px;
        overflow: hidden;
    }

    .contact-top {
        margin-bottom: 2px;
    }

    .contact-top p {
        font-family: Arial, Helvetica, sans-serif;
        margin: 0 12px;
        font-size: 12px;
    }

    .contact-content-left,
    .contact-content-right {
        flex: 1 1 45%;
        padding: 30px;
    }

    .contact-content-left h2 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
    }

    .contact-content-left p {
        font-size: 16px;
        margin-bottom: 20px;
        line-height: 1.6;
        color: #666;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        margin-bottom: 5px;
        color: #333;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        color: #333;
    }

    .form-group textarea {
        resize: vertical;
        height: 150px;
    }

    .button {
        display: inline-block;
        padding: 12px 20px;
        background-color: #28a745;
        color: #fff;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-align: center;
        transition: background-color 0.3s ease;
    }

    .button:hover {
        background-color: #218838;
    }

    .contact-bg p {
        margin: 10px 0;
    }

    .contact-bg span {
        display: block;
        font-size: 16px;
        font-weight: none;

    }

    .contact-bg {
        font-family: Arial, sans-serif;
        color: #333;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .contact {
            flex-direction: column;
        }

        .contact-content-left,
        .contact-content-right {
            flex: 1 1 100%;
            padding: 20px;
        }
    }
</style>

<?php include("navbar.php"); ?>

<div class="contact">
    <div class="contact-container">
        <div class="contact-content-left">
            <h2>Liên Hệ Với Chúng Tôi</h2>
            <p>
                Nếu bạn có bất kỳ câu hỏi hoặc phản hồi nào, vui lòng điền vào mẫu dưới
                đây. Chúng tôi sẽ liên hệ lại với bạn trong thời gian sớm nhất.
            </p>

            <form action="./php/submit_contact.php" method="post">
                <div class="form-group">
                    <label for="name">Họ và Tên:</label>
                    <input type="text" id="name" name="name" required />
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required />
                </div>
                <div class="form-group">
                    <label for="phone">Điện thoại:</label>
                    <input type="numer" id="phone" name="phone" required />
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ:</label>
                    <input type="text" id="address" name="address" required />
                </div>
                <div class="form-group">
                    <label for="message">Nội Dung:</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit" class="button">Gửi Liên Hệ</button>
            </form>
        </div>

        <div class="contact-content-right">
            <div class="contact-map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7836.5932399715475!2d106.6194855!3d10.8650291!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752b2a11844fb9%3A0xbed3d5f0a6d6e0fe!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buNYyBHaWFvIFRow7RuZyBW4bqtbiBU4bqjaSBUaMOgbmggUGjhu5EgSOG7kyBDaMOtIE1pbmggKFVUSCkgLSBDxqEgc-G7nyAz!5e0!3m2!1svi!2s!4v1723358690975!5m2!1svi!2s"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="contact-bg">
                <p>
                    <span style="font-weight: bold;">
                        Tâm Bảo Hành - Sửa Chữa Máy Ảnh PROCAM
                    </span>
                </p>

                <p>
                    <span style="font-weight: bold;"> Công Ty TNHH PROCAM (PROCAM Co., Ltd)</span>
                </p>

                <p>
                    <span>Địa chỉ: 70 Tố ký, Quận 12, TP.HCM</span>
                </p>

                <p>
                    <span>Điện thoại: 999 999 999 - Hotline: 999 999 999 - 999 999 999</span>
                </p>

                <p>
                    <span>Phòng Kỹ Thuật &amp; Sửa chữa: 999 999 999</span>
                </p>
                <p>
                    <span>Email: kqt@gmail.com - Website: www.kqtcamera.vn</span>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- footer  -->
<?php include("footer.php"); ?>