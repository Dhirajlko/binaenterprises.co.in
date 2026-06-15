<?php
// Form handling (exactly as in your original – nothing changed)
$form_success = false;
$form_error = false;
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_form'])) {
    $name = trim($_POST['name'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    $service = trim($_POST['service'] ?? '');
    $details = trim($_POST['details'] ?? '');
    
    if (empty($name) || empty($mobile) || empty($service)) {
        $form_error = true;
        $msg = '❌ कृपया नाम, मोबाइल और सेवा चुनें।';
    } elseif (!preg_match('/^[6-9]\d{9}$/', $mobile)) {
        $form_error = true;
        $msg = '❌ सही 10 अंकों का मोबाइल नंबर दर्ज करें।';
    } else {
        $to = "service@binaenterprises.co.in";
        $subject = "=?UTF-8?B?" . base64_encode("नया संपर्क फॉर्म: $service") . "?=";
        $message = "नाम: $name\nमोबाइल: $mobile\nसेवा: $service\nअतिरिक्त जानकारी: $details";
        $headers = "From: noreply@binaenterprises.co.in\r\n";
        $headers .= "Reply-To: noreply@binaenterprises.co.in\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
        if (mail($to, $subject, $message, $headers)) {
            $form_success = true;
            $msg = '✅ धन्यवाद! आपका फॉर्म सफलतापूर्वक भेज दिया गया। हम 24 घंटे में संपर्क करेंगे।';
        } else {
            $form_error = true;
            $msg = '❌ ईमेल भेजने में तकनीकी त्रुटि। कृपया बाद में प्रयास करें या मोबाइल से संपर्क करें।';
        }
        $_POST = [];
    }
}

include 'includes/header.php';
?>

    <!-- Hero 3D Section -->
    <section id="home" class="hero">
        <div class="hero-content">
            <h2>सभी ऑनलाइन <span class="gradient-text">फॉर्म भरने</span> की सुविधा</h2>
            <p>✔️ Govt Jobs | ✔️ UAN/PF | ✔️ Vehicle Insurance | ✔️ CSC Billing | ✔️ All Digital Forms</p>
            <a href="#contact" class="btn-3d">अभी सेवा लें →</a>
        </div>
        <div class="hero-3d-card">
            <div class="floating-card" id="hero3dCard">
                <i class="fas fa-cubes"></i>
                <h3>Trusted by 5000+</h3>
                <p>100% accurate form filling</p>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <h2 class="section-title">हमारी <span style="color:#f97316;">सेवाएँ</span> | Experience</h2>
    <div class="services-grid" id="services">
        <div class="tilt-card"><i class="fas fa-briefcase"></i><h3>सरकारी जॉब फॉर्म</h3><p>SSC, BANK, RAILWAY, POLICE</p></div>
        <div class="tilt-card"><i class="fas fa-id-card"></i><h3>UAN / PF Services</h3><p>Withdrawal, KYC, Passbook</p></div>
        <div class="tilt-card"><i class="fas fa-car"></i><h3>Vehicle Insurance</h3><p>New/Renewal, Claim Support</p></div>
        <div class="tilt-card"><i class="fas fa-file-invoice"></i><h3>सरकारी योजनाएँ</h3><p>PM Kisan, Ayushman, Ration Card</p></div>
        <div class="tilt-card"><i class="fas fa-receipt"></i><h3>CSC Billing</h3><p>Bill Pay, Recharge, Travel Booking</p></div>
        <div class="tilt-card"><i class="fas fa-edit"></i><h3>ऑनलाइन फॉर्म</h3><p>Pan, Aadhar, Passport, DL</p></div>
    </div>

    <!-- About Section -->
    <div class="about">
        <div class="about-flex">
            <div style="flex:1">
                <h3>Bina Enterprises – आपका डिजिटल साथी</h3>
                <p>हम 12+ साल से ऑनलाइन फॉर्म भरने, CSC, बीमा और सरकारी योजनाओं में विश्वसनीय सेवा दे रहे हैं। तेज़, सटीक और सस्ता।</p>
                <ul class="about-list">
                    <li><i class="fas fa-check-circle" style="color:#f97316;"></i> 100% फॉर्म सबमिशन गारंटी</li>
                    <li><i class="fas fa-check-circle" style="color:#f97316;"></i> व्हाट्सएप सपोर्ट</li>
                    <li><i class="fas fa-check-circle" style="color:#f97316;"></i> सभी CSC डिजिटल सेवाएँ</li>
                </ul>
            </div>
            <div style="flex:1; text-align:center;">
                <i class="fas fa-hands-helping" style="font-size: 8rem; color:#f97316; opacity:0.7;"></i>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div id="contact" class="contact-premium">
        <div class="contact-grid">
            <div class="contact-cards">
                <div class="contact-card">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <strong>Office Address</strong>
                        <span>Nilmatha Road, Diptyganj, Lucknow, U.P. 226002</span>
                    </div>
                </div>
                <div class="contact-card">
                    <i class="fas fa-phone-alt"></i>
                    <div>
                        <strong>Call Us</strong>
                        <a href="tel:+917880385706">+91 7880385706</a>
                    </div>
                </div>
                <div class="contact-card">
                    <i class="fab fa-whatsapp"></i>
                    <div>
                        <strong>WhatsApp Support</strong>
                        <a href="https://wa.me/917880385706" target="_blank">Chat on WhatsApp</a>
                    </div>
                </div>
                <div class="contact-card">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <strong>Email Us</strong>
                        <a href="mailto:service@binaenterprises.co.in">service@binaenterprises.co.in</a>
                    </div>
                </div>
                <div class="contact-card">
                    <i class="fas fa-clock"></i>
                    <div>
                        <strong>Working Hours</strong>
                        <span>10:00 AM - 7:00 PM (Mon-Sat)</span>
                    </div>
                </div>
            </div>
            
            <div class="contact-form-wrapper">
                <?php if ($form_success): ?>
                    <div class="alert alert-success"><?php echo $msg; ?></div>
                <?php elseif ($form_error): ?>
                    <div class="alert alert-error"><?php echo $msg; ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="आपका नाम *" required>
                    </div>
                    <div class="form-group">
                        <input type="tel" name="mobile" placeholder="मोबाइल नंबर *" required>
                    </div>
                    <div class="form-group">
                        <select name="service" required>
                            <option value="">– सेवा चुनें –</option>
                            <option>(ITR, BOOK-KEEPING ,GST) SUPPORT</option>
                            <option>सरकारी जॉब फॉर्म (SSC, BANK, RAILWAY, POLICE, TEACHER)</option>
                            <option>UAN / PF Services (Withdrawal, KYC, Passbook, Transfer)</option>
                            <option>Vehicle Insurance (Car, Bike, Commercial – New/Renewal)</option>
                            <option>सरकारी योजनाएँ (PM Kisan, Ayushman, Ration Card, Scholarship)</option>
                            <option>CSC Billing & Payment (Electricity, Water, Gas, Recharge)</option>
                            <option>PAN Card Application / Correction</option>
                            <option>Aadhar Card Update (Address, Mobile, Bio-metric)</option>
                            <option>Driving Licence (Learning & Permanent)</option>
                            <option>Voter ID (New, Correction, Transfer)</option>
                            <option>Passport Application & Appointment</option>
                            <option>IRCTC / Train Ticket Booking</option>
                            <option>Travel Booking (Flight, Bus, Hotel)</option>
                            <option>PF / EPFO Claim Assistance</option>
                            <option>Ayushman Card (New & Update)</option>
                            <option>PM Kisan Samman Nidhi Registration</option>
                            <option>Ration Card (New, Addition, Deletion)</option>
                            <option>Scholarship Forms (Pre-Matric, Post-Matric)</option>
                            <option>Gas Connection (New, Subsidy Transfer)</option>
                            <option>Internet / Mobile Recharge & Bill Payment</option>
                            <option>राशन कार्ड / आधार सीडिंग</option>
                            <option>अन्य ऑनलाइन फॉर्म (जो सूची में न हो)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="details" placeholder="अतिरिक्त जानकारी (वैकल्पिक)"></textarea>
                    </div>
                    <button type="submit" name="submit_form" class="btn-3d" style="width:100%;">अभी जमा करें →</button>
                </form>
            </div>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>