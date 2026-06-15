<?php

$quote_sent = false;

$conn = new mysqli(
    "localhost",
    "BINA",
    "Vidhina#123",
    "BINADATA"
);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quick_quote'])) {

    $name = trim($_POST['name'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    $service = trim($_POST['service'] ?? '');

    if (!empty($name) && !empty($mobile) && preg_match('/^[6-9]\d{9}$/', $mobile)) {

        $stmt = $conn->prepare(
            "INSERT INTO leads(name,mobile,service)
             VALUES(?,?,?)"
        );

        $stmt->bind_param(
            "sss",
            $name,
            $mobile,
            $service
        );

        $stmt->execute();
$to = "service@binaenterprises.co.in";

$subject = "New Lead Received";

$message = "New Service Request Received\n\n";
$message .= "Name: ".$name."\n";
$message .= "Mobile: ".$mobile."\n";
$message .= "Service: ".$service."\n";
$message .= "Date: ".date('d-m-Y h:i A');

$headers = "From: service@binaenterprises.co.in\r\n";

$mail_sent = mail($to, $subject, $message, $headers);

if($mail_sent){
    error_log("Mail Sent");
}else{
    error_log("Mail Failed");
}
        $quote_sent = true;
    }
}
?>
<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>हमारी सेवाएँ | Bina Enterprises – 3D Online Form Filling & CSC Services</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at 10% 20%, #0a0f1f, #03050b);
            color: #ffffff;
            overflow-x: hidden;
            line-height: 1.5;
        }

        /* Animated Gradient Background */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            background: linear-gradient(125deg, #0f172a 0%, #020617 40%, #000000 100%);
            background-size: 200% 200%;
            animation: bgWave 12s ease infinite;
        }
        @keyframes bgWave {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Floating orbs with glow */
        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }
        .shape {
            position: absolute;
            background: radial-gradient(circle, rgba(249,115,22,0.15), rgba(250,204,21,0.05));
            backdrop-filter: blur(8px);
            border-radius: 50%;
            animation: float 25s infinite ease-in-out;
            pointer-events: none;
        }
        @keyframes float {
            0% { transform: translate(0,0) rotate(0deg) scale(1); opacity: 0.3; }
            50% { transform: translate(40px,-40px) rotate(10deg) scale(1.2); opacity: 0.6; }
            100% { transform: translate(-20px,20px) rotate(-5deg) scale(0.9); opacity: 0.3; }
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
            position: relative;
            z-index: 2;
        }

        /* Glassmorphic Navbar */
        .navbar {
            backdrop-filter: blur(20px);
            background: rgba(15, 25, 45, 0.65);
            border-radius: 80px;
            margin: 25px auto 35px;
            padding: 12px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            transition: all 0.3s;
        }
        .navbar:hover {
            border-color: rgba(249,115,22,0.5);
            box-shadow: 0 12px 40px rgba(249,115,22,0.2);
        }
        .logo h1 {
            font-size: 1.7rem;
            font-weight: 800;
            background: linear-gradient(135deg, #ffffff, #f97316);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: -0.5px;
        }
        .logo p {
            font-size: 0.7rem;
            color: #cbd5e6;
            letter-spacing: 1px;
        }
        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }
        .nav-links a {
            color: #f1f5f9;
            text-decoration: none;
            font-weight: 500;
            transition: 0.2s;
            position: relative;
        }
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #f97316, #facc15);
            transition: width 0.3s ease;
        }
        .nav-links a:hover::after,
        .nav-links a.active::after {
            width: 100%;
        }
        .nav-links a:hover, .nav-links a.active {
            color: #f97316;
        }

        /* 3D Button */
        .btn-3d {
            background: linear-gradient(95deg, #f97316, #ea580c);
            border: none;
            padding: 10px 32px;
            border-radius: 60px;
            font-weight: 600;
            color: white;
            box-shadow: 0 5px 15px rgba(249,115,22,0.4);
            transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            display: inline-block;
            text-decoration: none;
            cursor: pointer;
            letter-spacing: 0.3px;
        }
        .btn-3d:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 28px rgba(249,115,22,0.6);
            background: linear-gradient(95deg, #ff841f, #f96510);
        }
        .btn-3d:active {
            transform: translateY(2px);
        }

        /* Premium Service Cards */
        .service-detail-card {
            background: rgba(20, 30, 55, 0.55);
            backdrop-filter: blur(18px);
            border-radius: 56px;
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.15);
            transition: all 0.4s ease;
            box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
        }
        .service-detail-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(249,115,22,0.1), transparent);
            transition: left 0.6s;
        }
        .service-detail-card:hover::before {
            left: 100%;
        }
        .service-detail-card:hover {
            transform: translateY(-8px);
            border-color: #f97316;
            box-shadow: 0 28px 40px -12px rgba(249,115,22,0.3);
        }
        .service-header {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }
        .service-header i {
            font-size: 3rem;
            color: #facc15;
            filter: drop-shadow(0 0 8px rgba(250,204,21,0.4));
        }
        .service-header h2 {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(120deg, #fff, #facc15);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .service-desc {
            color: #e2e8f0;
            margin: 0.8rem 0;
            line-height: 1.6;
            font-size: 1rem;
        }
        .service-features {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            margin: 1.2rem 0;
        }
        .service-features span {
            background: rgba(249, 115, 22, 0.2);
            backdrop-filter: blur(4px);
            padding: 6px 18px;
            border-radius: 60px;
            font-size: 0.8rem;
            font-weight: 500;
            border: 1px solid rgba(249, 115, 22, 0.5);
            transition: 0.2s;
        }
        .service-features span:hover {
            background: rgba(249, 115, 22, 0.5);
            transform: scale(1.02);
        }
        .quote-btn {
            margin-top: 0.5rem;
        }

        /* Hero Section */
        .page-hero {
            text-align: center;
            padding: 30px 0 20px;
            margin-top: 1rem;
        }
        .page-hero h1 {
            font-size: 2.5rem;
            background: linear-gradient(135deg, #f97316, #facc15, #ffed4a);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: 800;
        }

        /* Quick Quote Form – Enhanced */
        .quick-quote {
            background: rgba(0, 0, 0, 0.65);
            backdrop-filter: blur(24px);
            border-radius: 56px;
            padding: 2.2rem;
            margin: 2rem 0 3rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: 0.3s;
        }
        .quick-quote:hover {
            border-color: rgba(249, 115, 22, 0.6);
            box-shadow: 0 10px 30px rgba(249, 115, 22, 0.2);
        }
        .quick-form {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
            margin-top: 1.5rem;
        }
        .quick-form input, .quick-form select {
            padding: 14px 22px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 80px;
            color: white;
            font-family: inherit;
            font-size: 1rem;
            min-width: 220px;
            backdrop-filter: blur(4px);
            transition: all 0.3s;
        }
        .quick-form input:focus, .quick-form select:focus {
            outline: none;
            border-color: #f97316;
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 0 12px rgba(249,115,22,0.3);
        }
        .quick-form select option {
            background: #0f172a;
            color: white;
        }
        .alert {
            padding: 14px 20px;
            border-radius: 80px;
            margin-bottom: 1.5rem;
            background: linear-gradient(95deg, #15803d, #166534);
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            animation: fadeIn 0.5s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px);}
            to { opacity: 1; transform: translateY(0);}
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 1.8rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #94a3b8;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar { flex-direction: column; gap: 1rem; border-radius: 40px; padding: 18px; }
            .service-header h2 { font-size: 1.3rem; }
            .service-header i { font-size: 2rem; }
            .quick-form input, .quick-form select { width: 100%; }
            .page-hero h1 { font-size: 1.8rem; }
            .service-detail-card { padding: 1.5rem; }
        }
    </style>
</head>
<body>
<div class="animated-bg"></div>
<div class="floating-shapes" id="shapes"></div>

<div class="container">
    <nav class="navbar">
        <div class="logo"><h1>BINA <span style="color:#f97316;">ENTERPRISES</span></h1><p>Digital Service Hub</p></div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="service.php" class="active">Services</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <a href="#quick-quote" class="btn-3d">Enquire →</a>
    </nav>
    <!-- Quick Quote Form -->
    <div class="quick-quote" id="quick-quote">
        <h3>➤ त्वरित सेवा लें – बस नाम और मोबाइल भरें</h3>

        <?php if ($quote_sent): ?>
            <div class="alert alert-success">
                ✅ हम आपसे जल्द संपर्क करेंगे।
            </div>
        <?php endif; ?>

        <form method="POST" class="quick-form">
            <input type="text" name="name" placeholder="आपका नाम" required>
            <input type="tel" name="mobile" placeholder="मोबाइल नंबर" required>

            <select name="service" required>
                <option value="">– सेवा चुनें –</option>
                <option>(ITR, BOOK-KEEPING ,GST) SUPPORT</option>
                <option>IRCTC / Train Ticket Booking</option>
                <option>Flight Booking (Domestic / International)</option>
                <option>Bus Ticket Booking</option>
                <option>Hotel Booking</option>
                <option>सरकारी जॉब फॉर्म</option>
                <option>UAN / PF Services</option>
                <option>Vehicle Insurance</option>
                <option>सरकारी योजनाएँ</option>
                <option>CSC Billing & Payment</option>
                <option>Aadhar Card Update</option>
                <option>PAN Card</option>
                <option>Driving Licence</option>
                <option>Passport Application</option>
                <option>Voter ID</option>
                <option>अन्य ऑनलाइन फॉर्म</option>
            </select>

            <button type="submit" name="quick_quote" class="btn-3d">
                सबमिट करें →
            </button>
        </form>

        <p style="margin-top:1rem;">
            ✅ हम आपको 10 मिनट में कॉल/WhatsApp करेंगे।
        </p>
    </div>

    <!-- बाकी सभी सेवाओं का हेडर -->
    <div class="page-hero">
        <h1>हमारी <span style="color:#f97316;">अन्य सेवाएँ</span></h1>
        <p>सरकारी जॉब फॉर्म, UAN/PF, बीमा, CSC, आधार, PAN, पासपोर्ट और भी बहुत कुछ</p>
    </div>
    
    <!-- ✅ IRCTC / Travel Booking Block -->
    <div class="top-irctc-block">
        <div class="service-detail-card">
            <div class="service-header">
                <i class="fas fa-train"></i>
                <h2>IRCTC / Travel Booking (Flight, Bus, Hotel)</h2>
            </div>
            <div class="service-desc">
                रेलवे टिकट बुकिंग, IRCTC अकाउंट, कैंसलेशन, टीएटीकल टिकट, फ्लाइट, बस, होटल बुकिंग और यात्रा पैकेज।
            </div>
            <div class="service-features">
                <span>IRCTC Agent</span>
                <span>Flight Offers</span>
                <span>Hotel Discount</span>
            </div>
            <a href="#quick-quote" class="btn-3d quote-btn">टिकट बुक करें →</a>
        </div>
    </div>

    <div class="services-detailed">
        <div class="service-detail-card"><div class="service-header"><i class="fas fa-briefcase"></i><h2>सरकारी जॉब फॉर्म</h2></div><div class="service-desc">SSC, Bank, Railway, Police, Teacher, Patwari – फॉर्म भरना, फीस जमा, फोटो क्रॉप, सबमिशन।</div><div class="service-features"><span>Notification Alert</span><span>Form Correction</span><span>Admit Card</span></div><a href="#quick-quote" class="btn-3d quote-btn">अभी पूछताछ करें →</a></div>
        
        <div class="service-detail-card"><div class="service-header"><i class="fas fa-id-card"></i><h2>UAN / PF Services</h2></div><div class="service-desc">UAN Activation, KYC, PF Withdrawal (Form 19,10C,31), Transfer, Passbook Download.</div><div class="service-features"><span>Claim Assistance</span><span>KYC Seeding</span><span>Online Transfer</span></div><a href="#quick-quote" class="btn-3d quote-btn">PF सहायता लें →</a></div>
        
        <div class="service-detail-card"><div class="service-header"><i class="fas fa-car"></i><h2>Vehicle Insurance</h2></div><div class="service-desc">Car, Bike, Commercial – New/Renewal, Third Party & Comprehensive, Claim Support.</div><div class="service-features"><span>Instant Policy</span><span>Claim Support</span><span>Best Premium</span></div><a href="#quick-quote" class="btn-3d quote-btn">Insurance Quote →</a></div>
        
        <div class="service-detail-card"><div class="service-header"><i class="fas fa-file-invoice"></i><h2>सरकारी योजनाएँ</h2></div><div class="service-desc">PM Kisan, Ayushman Card, Ration Card, Scholarship, Pension Yojana.</div><div class="service-features"><span>Free Consultation</span><span>Document Guide</span><span>Track Status</span></div><a href="#quick-quote" class="btn-3d quote-btn">योजना का लाभ उठाएँ →</a></div>
        
        <div class="service-detail-card"><div class="service-header"><i class="fas fa-receipt"></i><h2>CSC Billing & Payment</h2></div><div class="service-desc">बिजली/पानी/गैस बिल, मोबाइल/DTH रिचार्ज, FASTag, IRCTC, बस/फ्लाइट/होटल बुकिंग।</div><div class="service-features"><span>Instant Receipt</span><span>No Extra Fee</span><span>Home Delivery</span></div><a href="#quick-quote" class="btn-3d quote-btn">बिल भुगतान करें →</a></div>
        
        <div class="service-detail-card"><div class="service-header"><i class="fas fa-id-card"></i><h2>Aadhar Card Update</h2></div><div class="service-desc">नाम, पता, मोबाइल, बायोमेट्रिक अपडेट, ई-KYC, PVC कार्ड ऑर्डर।</div><div class="service-features"><span>Biometric Available</span><span>Same Day</span><span>Digital Copy</span></div><a href="#quick-quote" class="btn-3d quote-btn">Aadhar अपडेट कराएँ →</a></div>
        
        <div class="service-detail-card"><div class="service-header"><i class="fas fa-id-card"></i><h2>PAN Card</h2></div><div class="service-desc">New PAN, Correction, Reprint, e-PAN, TIN-PAN Linking.</div><div class="service-features"><span>Instant e-PAN</span><span>Correction Expert</span><span>Fast Delivery</span></div><a href="#quick-quote" class="btn-3d quote-btn">PAN Card लें →</a></div>
        
        <div class="service-detail-card"><div class="service-header"><i class="fas fa-edit"></i><h2>Driving Licence</h2></div><div class="service-desc">Learning, Permanent, Renewal, International Driving Permit.</div><div class="service-features"><span>Slot Booking</span><span>Test Guide</span><span>Smart Card</span></div><a href="#quick-quote" class="btn-3d quote-btn">Driving Licence सहायता →</a></div>
        
        <div class="service-detail-card"><div class="service-header"><i class="fas fa-passport"></i><h2>Passport & Voter ID</h2></div><div class="service-desc">Passport Application, Appointment, Voter ID (New, Correction, e-EPIC).</div><div class="service-features"><span>Passport Appointment</span><span>Voter Correction</span><span>Fast Process</span></div><a href="#quick-quote" class="btn-3d quote-btn">Passport / Voter ID →</a></div>
    </div>

    <p style="margin-top:1rem; font-size:0.9rem;">✅ हम आपको 10 मिनट में कॉल/WhatsApp करेंगे।</p>

    <footer>
        <p>© 2012 Bina Enterprises | सभी ऑनलाइन फॉर्म सहायता | Designed with 3D interaction by Leo Computers</p>
    </footer>
</div>

<script>
    const shapesContainer = document.getElementById('shapes');
    for(let i=0;i<14;i++) {
        let shape = document.createElement('div');
        shape.classList.add('shape');
        let size = Math.random() * 180 + 40;
        shape.style.width = size + 'px';
        shape.style.height = size + 'px';
        shape.style.top = Math.random() * 100 + '%';
        shape.style.left = Math.random() * 100 + '%';
        shape.style.animationDelay = Math.random() * 12 + 's';
        shape.style.animationDuration = Math.random() * 20 + 12 + 's';
        shapesContainer.appendChild(shape);
    }
    const cards = document.querySelectorAll('.service-detail-card');
    cards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const cx = rect.width/2, cy = rect.height/2;
            const rx = (y - cy)/25, ry = (cx - x)/25;
            card.style.transform = `perspective(1000px) rotateX(${rx}deg) rotateY(${ry}deg) translateY(-6px)`;
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0px)';
        });
    });
</script>
</body>
</html>