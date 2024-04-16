@extends('layouts.sitelayout')

@section('header_scripts')
    @toastr_css
    
<style>
 .layer-overlay::before {
    background: linear-gradient(to right,#063248,#156e9b) !important;
}
.text-theme-colored2 {
    color: rgb(81, 172, 55) !important;
}
.text-colored2{
    color: rgb(81, 172, 55) !important;
}

.text-uppercasetext-theme-colored{
    font-size:25px !important;
    font-weight:800 !important;
}

.inner-header h2{
    font-weight:800 !important;
}

.inner-header h2,
#tandc h2
{
    font-family: 'Poppins',sans-serif;
    font-size:16px;
    font-weight: 400;
    line-height: 2;
}
.inner-header h2{
    color:#fff !important;
}
.about p,
#tandc p,
#tandc li
{
    line-height:1.8;
    color:#555;
    font-weight:400;
    font-family: 'Poppins',sans-serif;
    line-height: 2;
    
}
#tandc li
{
    /*padding-left:40px;*/
}
#tandc li::before{
    font-family: "Font Awesome 5 Free";
    content: "\f058";
    font-weight: 900;
    color: #51ac37;
    font-size: 17px;
    /*position: absolute;*/
    padding-right: 20px;
    left: 0;
    /*padding-top: 5px;*/
}

#tandc li::after{
    content:"";
    padding-right:20px;
}

@media screen and (max-width: 767px) and (min-width: 320px)
{
   
}

@media screen and (max-width: 1024px) and (min-width: 768px)
{
   
}


</style>
    
@stop

@section('content')

<!--Start Page Banner -->
    <div class="main-content">
    <section class="inner-header divider layer-overlay overlay-theme-colored-9">
        <div class="container pt-50 pb-50">
            <!-- Section Content -->
            <div class="section-content">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="text-theme-colored2 font-36">{{ ucfirst($title) }}</h2>
                        <ol class="breadcrumb text-left mt-10 white">
                            <li><a href="{{url('/')}}">Home</a></li>
                            {{--<li><a href="#">Pages</a></li>--}}
                            <li class="active">{{ ucfirst($title) }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
 <!-- End Page Banner -->
 
 
 <!--=========== Start T&C Banner ===========-->
 <section id="tandc">

     <div class="container pt-50 pb-50">
         <p align="center">
         <h2 class="text-uppercasetext-theme-colored mt-0 mb-0 mt-sm-30">Course <span class="text-colored2">Agreement</span></h2>
         </p>
         {{--<p>--}}
             {{--<em>Effective Date: January 1, 2022</em>--}}
         {{--</p>--}}
         <p>
             THE AGREEMENT: This Course Agreement (hereinafter, "Agreement") is made by
             and between, a corporation, incorporated under the laws of England &amp;
             Wales, hereinafter referred to as "Course Provider," and you, further
             defined below, as a participant in the Course, also defined below.
         </p>
         <p>
             All parts and sub-parts of this Agreement are specifically incorporated by
             reference here. This Agreement shall govern the use of all pages and
             screens in and on the Course and Products (all collectively referred to as
             "Course") and any services provided by or on this Course Provider through
             the Course ("Services") and/or on the Course Provider's website
             ("Website").
         </p>
         <p>
             <strong>
                 <br/>
                 Article 1 - DEFINITIONS:
             </strong>
         </p>
         <p>
             A) The parties referred to in this Agreement shall be defined as follows:
         </p>
            <ol>
                <li>Course Provider, Imperial Learning Ltd is a company incorporated in
                    England and Wales under the registration number 07915768 whose registered
                    office is located at City Point, 1 Ropemaker Street, London, EC2Y 9HU and
                    trading as ‘Next Learn Academy’ or ‘NLA’: Course Provider, as the creator,
                    operator, and publisher of the Course is responsible for providing the
                    Course publicly. Course Provider, us, we, our, ours, and other first-person
                    pronouns will refer to the Course Provider, as well as, if applicable, all
                    employees and affiliates of the Course Provider.</li>
                <li>You, the user, the participant: You, as the participant in the course
                    and user of the Website, will be referred to throughout this Agreement with
                    second-person pronouns such as you, your, yours, or as user or participant.</li>
                <li>Parties: Collectively, the parties to this Agreement (Course Provider
                    and You) will be referred to as Parties.</li>
            </ol>

         <p>
             B) The other definitions are as follows:
         </p>
         <ol>
             <li>“Classroom Course” means physical face-to-face instruction conducted in
             person by an instructor/tutor to students in an organised manner utilising
                 a lesson plan.</li>

             <li>“Course Fee” means the fee payable for any Course or product but
             excludes any delivery charges payable in relation to the delivery of Course
             Materials or certificates, if applicable, and any import duties, taxes, and
             customs clearances that may be payable.
             </li>
             <li>“Course Materials” means the materials provided by us in the course of
             the delivery of any Online Course, which may be (i) Online Study Materials
             and/or (ii) Physical Study Materials.</li>
             <li>“Live Online Course” means virtual online face-to-face instruction
             conducted in person by an instructor/tutor to students in an organised
             manner utilising a lesson plan.
             </li>
             <li>“Online Course” means all courses which are listed on the website and
             can be accessed at any time with the login credentials provided.
             </li>
             <li>“Online Study Materials” means any material in an electronic format
             which may be (i) downloaded from the Website or (ii) accessed and viewed on
             the Website, including, but not limited to, PDFs, MP3s, JPEGs, MPEG4s, and
             MOVs.
             </li>
             <li>“Physical Study Materials” means any material in a physical format,
             including, Printed manuals, DVDs, CD Rom, Blu-ray, and Audio CDs.
             </li>
             <li>“Website” means www.nextlearnacademy.com or any other domain operated
             by Imperial Learning Ltd.
             </li>
         </ol>
         <p>
             <strong>
                 <br/>
                 Article 2 - ASSENT &amp; ACCEPTANCE:
             </strong>
         </p>
         <p>
             By purchasing and/or participating in the Course or accessing the Course,
             you warrant that you have read and reviewed this Agreement and that you
             agree to be bound by it. If you do not agree to be bound by this Agreement,
             please cease your participation in the Course immediately. If you do so
             after purchase, you will not be entitled to any refund unless the criteria
             listed out in the refund policy are met. Course Provider only agrees to
             provide the Course to you if you assent to this Agreement.
         </p>
         <p>
             <strong></strong>
         </p>
         <p>
             <strong></strong>
         </p>
         <p>
             <strong>
                 Article 3 – LICENCE TO USE WEBSITE &amp; ACCESS COURSE MATERIALS:
             </strong>
         </p>
         <p>
             We may provide you with certain information as a result of accessing the
             Course through the Website. Such information may include but is not limited
             to, documentation, data, or information developed by us and other materials
             which may assist in your participation in the Course ("Materials"). Subject
             to this Agreement, we grant you a non-exclusive, limited, non-transferable,
             and revocable licence to use the Materials solely in connection with your
             participation in the Course and your use of the Website. The Materials may
             not be used for any other purpose, and this licence terminates upon your
             completion of the Course, your cessation of use of the Course or the
             Website, or at the termination of this Agreement.
         </p>
         <p>
             <strong>
                 <br/>
                 Article 4 - COURSE TERMS:
             </strong>
         </p>
         <p>
             The Course does not have a structured start date, which means you may begin
             it at any time except classroom courses and live online classes. Whether or
             not the Course has been completed, it will expire the following amount of
             time after purchase: As specified on the course page or 12 months in
             absence of such duration on the course page or elsewhere on our website.
         </p>
         <p>
             The Course and any of its accompanying Materials may not be shared with any
             party. If we suspect that the Course or Materials are being shared and/or
             that you have shared your log-in information with any party, we reserve the
             right to immediately terminate your access to the Course, at our sole and
             exclusive discretion.
         </p>
         <p>
             We do not offer any promises or guarantees with regard to our Course or
             Course Materials. You hereby acknowledge and agree:
         </p>
         <p>
             A) You are solely and exclusively responsible for the choices that you make
             with regard to this Course, the Materials contained within, or any
             significant changes to your business or life;
         </p>
         <p>
             B) You are solely and exclusively responsible for your own mental health,
             physical health, business decisions, and any other actions or inaction you
             choose to take;
         </p>
         <p>
             C) We are not liable for any result or non-result or any consequences which
             may come about due to your participation in the Course;
         </p>
         <p>
             D) We do not provide therapy or medical services and you are responsible
             for procuring these services at your own will and discretion if needed.
         </p>
         <p>
             <strong>
                 <br/>
                 Article 5 - INTELLECTUAL PROPERTY:
             </strong>
         </p>
         <p>
             You agree that the Materials, the Course, the Website, and any other
             Services provided by the Course Provider are the property of the Course
             Provider, including all copyrights, trademarks, trade secrets, patents, and
             other intellectual property ("Company IP"). You agree that the Company owns
             all rights, title, and interest in and to the Company IP and that you will
             not use the Company IP for any unlawful or infringing purpose. You agree
             not to reproduce or distribute the Company IP in any way, including
             electronically or via registration of any new trademarks, trade names,
             service marks, or Uniform Resource Locators (URLs), without express written
             permission from the Company.
         </p>
         <p>
             <strong>
                 <br/>
                 Article 6 - CONTENT YOU POST:
             </strong>
         </p>
         <p>
             Through your participation in the Course and your use of the Website, you
             may be permitted to post materials to the Course pages and other parts of
             the Website ("User Contributions"). You hereby grant Course Provider a
             royalty-free, non-exclusive, worldwide licence to copy, display, use,
             broadcast, transmit and make derivative works of User Contributions you
             post. The Course Provider claims no further proprietary rights in your User
             Contributions.
         </p>
         <p>
             You also agree to comply with the "Acceptable Use" provision of this
             Agreement for all User Contributions that you post, including and
             especially to not violate the intellectual property rights of any third
             party through your User Contributions.
         </p>
         <p>
             We as the administrator of the website will ensure no user misuses other
             user contributions. However, if you feel that any of your intellectual
             property rights have been infringed or otherwise violated by the posting of
             information or media by another of our users, please contact us and let us
             know immediately.
         </p>
         <p>
             <strong>
                 <br/>
                 Article 7 - YOUR OBLIGATIONS:
             </strong>
         </p>
         <p>
             As a participant of the Course, you will be asked to register with us. When
             you do so, you will choose a user identifier, which may be your email
             address or another term, as well as a password. You may also provide
             personal information, including, but not limited to, your name. You are
             responsible for ensuring the accuracy of this information. This identifying
             information will enable you to participate in the Course. You must not
             share such identifying information with any third party, and if you
             discover that your identifying information has been compromised, you agree
             to notify us immediately in writing. An email notification will suffice.
             You are responsible for maintaining the safety and security of your
             identifying information as well as keeping us apprised of any changes to
             your identifying information.
         </p>
         <p>
             The billing information you provide us, including credit card, billing
             address, and other payment information, is subject to the same
             confidentiality and accuracy requirements as the rest of your identifying
             information. Providing false or inaccurate information or using the Course
             or the Website to further fraud or unlawful activity is grounds for
             immediate termination of this Agreement.
         </p>
         <p>
             OBLIGATIONS: As a participant in the Course, you will be asked to undertake
             and complete the following obligations:
         </p>
         <p>
             We may request course-specific mandatory data including but not limited to
             your name, DOB, address confirmation, and proof of identification. These
             data need to be provided within the stated time period in the relevant
             communication without fail.
         </p>
         <p>
             <strong></strong>
         </p>
         <p>
             <strong>Article 8 - PAYMENT &amp; FEES:</strong>
         </p>
         <p>
             Unless otherwise specified in respect of a particular product, the Course
             Fee is payable either:
         </p>
         <p>
             (a) with a one-off lump-sum payment, payable with your purchase offer; or
         </p>
         <p>
             (b) in instalments, with payments being due at certain times over a set
             period of time, as specified on the Website and/or in a Brochure and/or as
             notified to you by a NLA customer services representative, with the first
             instalment (Initial Payment) being payable with your purchase offer.
             Subsequent instalments will be payable on agreed dates as agreed at the
             initial purchase.
         </p>
         <p>
             <strong>8.1 Instalment Plans</strong>
         </p>
         <p>
             By choosing to pay the Course Fee in instalments in accordance with Article
             8(b), you agree that:
         </p>
         <p>
             a) It is your responsibility to sign up for Gocardless account through the
             link which our customer support team sent or create the plan on your own;
         </p>
         <p>
             b) it is your responsibility to ensure that the instalment payments are
             made on the due dates;
         </p>
         <p>
             c) NLA is authorised to collect the instalment payments from the Gocardless
             account (or any other method as agreed at the initial purchase) when such
             instalments become due and payable;
         </p>
         <p>
             you will inform us by email at    <a href="mailto:info@infinitylearning.org.uk">info@nextlearnacademy.com</a>
             if you change your bank account which is linked to Gocardless account or if
             your bank account does not have sufficient funds on due dates or the bank
             account is no longer valid prior to your next instalment becoming due and
             payable;
         </p>
         <p>
             d) any failure to make payment of an instalment when due and payable
             constitutes a breach of the Contract and:
         </p>
         <ol>
             <li>unless otherwise agreed in writing by NLA, will result in you losing
                 the right to pay by instalments and all outstanding instalment amounts will
                 become immediately due and payable; and</li>
             <li>without prejudice to any other rights it may have, NLA may suspend or
                 cancel your access to the Online Course until the remaining instalment
                 amounts are paid in full;</li>
         </ol>

         <p>
             (e) subject to Article 9, where NLA takes action under Article 8.1(d)(ii),
             you will not be entitled to a refund of any amount already paid.
         </p>
         <p>
             8.2 The option of paying the Course Fee in instalments is offered subject
             to availability. Acceptance of your offer to purchase the Online Course and
             pay the Course Fee by instalments is at the sole discretion of NLA. NLA may
             withdraw the option of paying the Course Fee in instalments at any time at
             its sole discretion. Any such withdrawal shall not affect customers who
             have already purchased an Online Course and are paying the Course Fee in
             instalments at the date of such withdrawal.
         </p>
         <p>
             8.3 The total amount paid for any Online Course may differ depending on
             whether the Course Fee is paid for with a one-off lump sum payment or in
             instalments.
         </p>
         <p>
             8.4 Where the Course Fee is paid for:
         </p>
         <p>
             (a) with a one-off lump-sum payment, payments will be accepted by:
         </p>
         <ol>
             <li>PayPal;</li>
             <li>credit card (including Visa, MasterCard, and American Express) or
                 debit card; or</li>
             <li>bank transfer, which will need to be arranged directly with us over
                 the telephone (please see the contact page for contact details at
                 https://www.nextlearnacademy.com/contact-us/) or by e-mail at    <a href="mailto:info@infinitylearning.org.uk">info@nextlearnacademy.com</a>
                 ; or</li>
             <li>Direct Debit instructions</li>
         </ol>

         <p>
             (b) In instalments, payments initial payment will only be accepted as
             facilitated at the checkout page or as notified to you by a NLA customer
             services representative.
         </p>
         <p>
             8.5 In the unlikely event that your purchase offer was accepted at a time
             when the amount of the Course Fee displayed on the Website and/or in any
             Brochure is incorrect, NLA will notify you as soon as it reasonably can. If
             the correct amount of the Course Fee is higher than the amount displayed on
             the Website and/or in any Brochure, then NLA will contact you to notify you
             of the correct Course Fee, so you can decide whether or not you wish to
             continue with your order of the Online Course at the increased Course Fee.
             If you decide that you would like to cancel your order, NLA will gives you
             a full refund in respect of any amount you have already paid. If the
             correct Course Fee is lower, Frontier Bushcraft will refund you the
             difference between the amount which you have paid and the correct Course
             Fee payable.
         </p>
         <p>
             <strong>8.6 Retake Exam Fee </strong>
         </p>
         <p>
             If you are unable to successfully complete your exam on the first attempt,
             you are eligible to take a second attempt after paying a Retake Fee.
         </p>
         <p>
             Peoplecert (Axelos) Take2 Exam Option – Take2 is an add-on service
             exclusively offered for selected exams and becomes available only when the
             initial exam linked to it has a “fail” result. Take2 is not transferable,
             non-refundable, and cannot be redeemed for cash or credit, even if it isn’t
             eventually used. Candidates must schedule and take the re-sit exam within 6
             months from the date of their initial exam. Take2 is exam-specific; it
             cannot be used for any other offering and is valid only for the exam
             originally purchased. Failing to show up for a Take2 exam appointment or
             not rescheduling the appointment prior to their scheduled appointment
             forfeits candidates’ ability to use the Take2 generated voucher. It can
             only be purchased up to 15 minutes before sitting an examination. Take 2 is
             not available for purchase after a failed exam.
         </p>
         <p>
             <strong>8.7 Ordering Printed Certificate </strong>
         </p>
         <p>
             Where applicable, an e-certificate will be issued free of charge. Printed
             certificates can be ordered at your discretion through the link provided on
             the website. The printed certificate will be charged separately as
             mentioned on the website at the checkout point of the certificate ordering
             page.
         </p>
         <p>
             <strong>8.8 Re-ordering Printed Certificate</strong>
         </p>
         <p>
             A printed certificate may require to be re-ordered in the following
             circumstances.
         </p>
         <ol>
             <li>Lost in the transit/after delivery - if we dispatch your certificate and
                 it is lost during delivery or if you lose your certificate after delivery
                 you will need to pay the Reorder Certificate Fee in order to get another
                 copy of the printed certificate.</li>
             <li>Delivery failure due to erroneous address – If the delivery address
                 provided by you is not the correct address, and any delivery failure due to
                 that reason will be charged a reordering fee in order to deliver the
                 certificate again. If the mistake is from our end, you will not be charged
                 any additional fee in order to deliver the certificate to the correct
                 address.</li>
             <li>In Transit Damages – Any damages to the printed certificate during the
                 transit will not be our responsibility. We ensure the certificate is posted
                 in its original condition and best possible package to ensure no physical
                 damage will happen in transit.</li>
             <li>Changes to the certificate - If there is an error in your certificate
                 and it is informed to us within 3 months of the issuance, we will re-issue
                 the certificate free of charge if the error has been made on our part.
                 However, if the error is on the part of the learner providing incorrect
                 information, they will be required to pay the due fee for re-issue.
                 Re-ordering takes 2 to 4 weeks after request submission and verification.</li>
         </ol>

         <p>
             <strong>Article 9 – CANCELLATIONS &amp; REFUNDS:</strong>
         </p>
         <p>
             Under UK law, you may have the right to cancel your order and request a
             refund under certain valid circumstances as explained below, in accordance
             with this policy.
         </p>
         <p>
             <strong>9.1 General Terms</strong>
             <strong></strong>
         </p>
         <p>
             Following general terms and conditions will be applicable for refund
             requests for any kind of course purchased through our website.
         </p>
         <ul>
             <li>All refunds are subject to 14 days (conditions apply) validity period
                 from the date of the purchase</li>
             <li>In order to be eligible for a refund, the learner must not have accessed
                 the course materials except in the case of an issue with the course
                 materials or a technical issue.</li>
             <li>In order to be eligible for a refund due to significant quality/technical
                 issues with course materials, it needs to be proved with sufficient
                 evidence. The course provider has the discretion to decide whether the
                 course material/technical issues are qualified for a full/partial refund or
                 not.</li>
             <li>All other refund requests, we shall investigate and decide whether the
                 learner is eligible for the refund or not. The decision to accept the
                 refund request is the sole discretion of the course provider.</li>
             <li>All refund requests should be sent to    <a href="mailto:info@infinitylearning.org.uk">info@nextlearnacademy.com</a>
                 or posted to Imperial Learning Ltd, CityPoint, 1 Ropemaker Street, London,
                 EC2Y 9HU within 14 days from the date of purchase.</li>
             <li>Once you submit the refund request, our team will evaluate the request
                 and respond in writing within 3 working days from the submission of the
                 request. If you are eligible for the refund, the refund is deemed to be
                 approved and starts processing. In the event of rejection of the refund,
                 our team will inform you in writing of the reasons for non-eligibility.</li>
             <li>Where applicable, entry requirements are mentioned on the website. If you
                 fail to meet the entry requirements of the program your application will
                 not be accepted. In the event that your application is not accepted, your
                 course access fee will be deducted, and the remainder of your total paid
                 fee will be refunded to you.</li>
             <li>All refunds may apply 10% retention as a processing fee. However, this
                 charge is at the sole discretion of NLA management.</li>
             <li>If the refund is requested to an outside UK bank account where bank
                 charges are applicable, a 10% processing fee or bank charges whichever are
                 higher will be deducted from the amount paid and the net amount will be
                 refunded.</li>
             <li>There may be situations where our website breakdowns and interruptions
                 due to including but not limited to scheduled or unscheduled system
                 maintenance work. In such cases, you will not be able to access your
                 courses and no refunds will be eligible due to such situations.</li>
             <li>Any type of certificate delivery delays will not be eligible for a
                 refund.</li>
             <li>Fees paid for the certificates will not be refunded in the case of
                 certificates getting delayed unless we could not provide proof that the
                 certificate has been mailed. The course provider shall not be responsible
                 for any delays from the post under any circumstances.</li>
             <li>Any approved refund will take up to 30 days to process.</li>
             <li>No refund will be made due to an unsuccessful result at the examination.</li>
         </ul>

         <p>
             <strong>9.2 Classroom Courses</strong>
         </p>
         <p>
             Cancellations:
         </p>
         <p>
             Any cancellation made 14 days or more before the start date of the course
             will be eligible for a full refund. If you cancel less than 14 days before
             the start date of the course you will not be eligible for any refund.
         </p>
         <p>
             In the event that you are not qualified for the final exam, no refund will
             be issued in any circumstances.
         </p>
         <p>
             Rescheduling:
         </p>
         <p>
             Rescheduling of classroom courses is possible subject to the following
             criteria. You may reschedule the course up to 7 days before the start date
             of the course at no additional cost.
         </p>
         <p>
             We reserve the right to reschedule or cancel any classroom course and/or
             change the tutor stated on the course page. However, we shall notify the
             rescheduling/cancellation/change at least before 72 hours from the start
             time of the course. In the event of cancellation from NLA, you are eligible
             for a full refund only up to the amount you have paid. No other claims can
             be made due to the cancellation.
         </p>
         <p>
             <strong>9.3 Live online courses</strong>
         </p>
         <p>
             Cancellations:
         </p>
         <p>
             Cancellations received within 14 days of booking your place on the course
             will receive a full refund. However, if the cancellation request receives
             less than 14 days before the course start date, no refund will be eligible.
         </p>
         <p>
             Rescheduling:
         </p>
         <p>
             You may reschedule the course up to 14 days before the start date of the
             course at no additional cost.
         </p>
         <p>
             We reserve the right to reschedule or cancel any classroom course and/or
             change the tutor stated on the course page at least 72 hours from the start
             time of the course.
         </p>
         <p>
             <strong>9.4 Official Examinations </strong>
         </p>
         <p>
             Cancellations:
         </p>
         <p>
             No exam voucher will be cancelled or refunded after issuing.
         </p>
         <p>
             Rescheduling:
         </p>
         <p>
             Any exam rescheduling requests to be received 3 working days prior to the
             exam date and the rescheduling date should be within the exam voucher
             validity period. Such rescheduling will be subject to an admin fee as
             applicable.
         </p>
         <p>
             <strong>Article 10 - ACCEPTABLE USE:</strong>
         </p>
         <p>
             You agree not to use the Course or the Website for any unlawful purpose or
             any purpose prohibited under this clause. You agree not to use the Course
             or the Website in any way that could damage the Course, Website, Services,
             or general business of the Course Provider.
         </p>
         <p>
             a) You further agree not to use the Course or the Website:
         </p>
         <ol>
             <li>To harass, abuse, or threaten others or otherwise violate any person's
                 legal rights;</li>
             <li>To violate any intellectual property rights of the Course Provider or
                 any third party;</li>
             <li>To upload or otherwise disseminate any computer viruses or other
                 software that may damage the property of another;</li>
             <li>To perpetrate any fraud;</li>
             <li>To publish or distribute any obscene or defamatory material;</li>
             <li>To publish or distribute any material that incites violence, hate, or
                 discrimination towards any group;</li>
             <li>To unlawfully gather information about others.</li>
         </ol>

         <p>
             <strong>
                 <br/>
                 Article 11 - NO LIABILITY:
             </strong>
         </p>
         <p>
             The Course and Website are provided for informational purposes only. You
             acknowledge and agree that any information posted in the Course, in the
             Materials, or on the Website is not intended to be legal advice, medical
             advice, or financial advice, and no fiduciary relationship has been created
             between you and us. You further agree that your participation in the Course
             is at your own risk. We do not assume responsibility or liability for any
             advice or other information given in the Course, in the Materials, or on
             the Website. Furthermore, we are not liable for the examination or
             assignment results which you will achieve during or at the end of any
             course.
         </p>
         <p>
             <strong>
                 <br/>
                 Article 12 - REVERSE ENGINEERING &amp; SECURITY:
             </strong>
         </p>
         <p>
             You agree not to undertake any of the following actions:
         </p>
         <p>
             a) Reverse engineer, or attempt to reverse engineer or disassemble any code
             or software from or in the Course or Website;
         </p>
         <p>
             b) Violate the security of the Course or Website through any unauthorised
             access, circumvention of encryption or other security tools, data mining,
             or interference to any host, user, or network.
         </p>
         <p>
             <strong>
                 <br/>
                 Article 13 - INDEMNIFICATION:
             </strong>
         </p>
         <p>
             You agree to defend and indemnify the Course Provider and any of our
             affiliates/awarding bodies (if applicable) and hold us harmless against any
             and all legal claims and demands, including reasonable attorney's fees,
             which may arise from or relate to your participation in the Course, your
             use or misuse of the Website, your breach of this Agreement, or your
             conduct or actions. You agree that we shall be able to select our own legal
             counsel and may participate in our own defence, if we wish.
         </p>
         <p>
             <strong>
                 <br/>
                 Article 15 - SPAM POLICY:
             </strong>
         </p>
         <p>
             You are strictly prohibited from using Course for illegal spam activities,
             including gathering email addresses and personal information from others or
             sending any mass commercial emails.
         </p>
         <p>
             <strong>
                 <br/>
                 Article 16 - MODIFICATION &amp; VARIATION:
             </strong>
         </p>
         <p>
             We may, from time to time and at any time without notice to you, modify
             this Agreement. You agree that we have the right to modify this Agreement
             or revise anything contained herein. You further agree that all
             modifications to this Agreement are in full force and effect immediately
             upon posting on the Website and that modifications or variations will
             replace any prior version of this Agreement unless prior versions are
             specifically referred to or incorporated into the latest modification or
             variation of this Agreement.
         </p>
         <p>
             To the extent any part or sub-part of this Agreement is held ineffective or
             invalid by any court of law, you agree that the prior, effective version of
             this Agreement shall be considered enforceable and valid to the fullest
             extent.
         </p>
         <p>
             <strong>
                 <br/>
                 Article 17 - ENTIRE AGREEMENT:
             </strong>
         </p>
         <p>
             This Agreement constitutes the entire understanding between the Parties
             with respect to the Course. This Agreement supersedes and replaces all
             prior or contemporaneous agreements or understandings, written or oral.
         </p>
         <p>
             <strong>
                 <br/>
                 Article 18 - SERVICE INTERRUPTIONS:
             </strong>
         </p>
         <p>
             We may need to interrupt your access to the Course to perform maintenance
             or emergency services on a scheduled or unscheduled basis. You agree that
             your access to the Course and/or Website may be affected by unanticipated
             or unscheduled downtime, for any reason, but that we shall have no
             liability for any damage or loss caused as a result of such downtime.
         </p>
         <p>
             <strong>
                 <br/>
                 Article 19 - TERM, TERMINATION &amp; SUSPENSION:
             </strong>
         </p>
         <p>
             We may terminate this Agreement with you at any time for any reason, with
             or without cause. We specifically reserve the right to terminate this
             Agreement if you violate any of the terms outlined herein, including, but
             not limited to, violating the intellectual property rights of us or a third
             party, failing to comply with applicable laws or other legal obligations,
             and/or publishing or distributing illegal material. You may also terminate
             this Agreement at any time by contacting us and requesting termination. At
             the termination of this Agreement, any provisions that would be expected to
             survive termination by their nature shall remain in full force and effect.
         </p>
         <p>
             Please be advised that terminating this Agreement does not entitle you to a
             refund on any monies spent with us.
         </p>
         <p>
             <strong></strong>
         </p>
         <p>
             <strong>Article 20 - NO WARRANTIES:</strong>
         </p>
         <p>
             You agree that your participation in the Course and your use of the Website
             is at your sole and exclusive risk and that any Services provided by us are
             on an "As Is" basis. We hereby expressly disclaim any and all express or
             implied warranties of any kind, including, but not limited to the implied
             warranty of fitness for a particular purpose and the implied warranty of
             merchantability. We make no warranties that the Course or Website will meet
             your needs or that the Course or Website will be uninterrupted, error-free,
             or secure. We also make no warranties as to the reliability or accuracy of
             any information in the Course or on the Website. You agree that any damage
             that may occur to you, through your computer system, or as a result of loss
             of your data from your participation in the Course or your use of the
             Website is your sole responsibility and that we are not liable for any such
             damage or loss.
         </p>
         <p>
             <strong>
                 <br/>
                 Article 21 - LIMITATION ON LIABILITY:
             </strong>
         </p>
         <p>
             We are not liable for any damages that may occur to you as a result of your
             participation in the Course or your use of the Website, to the fullest
             extent permitted by law, as noted above. The maximum liability of the
             Course Provider arising from or relating to this Agreement is limited to
             the greater of one hundred (£100) GBP or the amount you paid to us in the
             last six (6) months. This section applies to any and all claims by you,
             including, but not limited to, lost profits or revenues, consequential or
             punitive damages, negligence, strict liability, fraud, or torts of any
             kind.
         </p>
         <p>
             <strong>
                 <br/>
                 Article 22 - GENERAL PROVISIONS:
             </strong>
         </p>
         <p>
             A) LANGUAGE: All communications made or notices given pursuant to this
             Agreement shall be in the English language.
         </p>
         <p>
             B) JURISDICTION, VENUE &amp; CHOICE OF LAW: Through your participation in
             the Course and your use of the Website, you agree that the laws of England
             &amp; Wales shall govern any matter or dispute relating to or arising out
             of this Agreement, as well as any dispute of any kind that may arise
             between you and us, with the exception of its conflict of law provisions.
             In case any litigation specifically permitted under this Agreement is
             initiated, the Parties agree to submit to the personal jurisdiction of the
             state and federal courts of the following county: England &amp; Wales. The
             Parties agree that this choice of law, venue, and jurisdiction provision is
             not permissive, but rather mandatory in nature. You hereby waive the right
             to any objection of venue, including assertion of the doctrine of forum
             non-conveniens or similar doctrine.
         </p>
         <p>
             C) ARBITRATION: In case of a dispute between the Parties relating to or
             arising out of this Agreement, the Parties shall first attempt to resolve
             the dispute personally and in good faith. If these personal resolution
             attempts fail, the Parties shall then submit the dispute to binding
             arbitration. The arbitration shall be conducted in England &amp; Wales. The
             arbitration shall be conducted by a single arbitrator, and such arbitrator
             shall have no authority to add Parties, vary the provisions of this
             Agreement, award punitive damages, or certify a class. The arbitrator shall
             be bound by applicable and governing law. Each Party shall pay its own
             costs and fees. Claims necessitating arbitration under this section
             include, but are not limited to: contract claims, tort claims, claims based
             on Federal and state law, and claims based on local laws, ordinances,
             statutes, or regulations. Intellectual property claims by us will not be
             subject to arbitration and may, as an exception to this sub-part, be
             litigated. The Parties, in agreement with this sub-part of this Agreement,
             waive any rights they may have to a jury trial in regard to arbitral
             claims.
         </p>
         <p>
             D) ASSIGNMENT: This Agreement, or the rights granted hereunder, may not be
             assigned, sold, leased, or otherwise transferred in whole or part by you.
             Should this Agreement, or the rights granted hereunder, be assigned, sold,
             leased, or otherwise transferred by Course Provider, the rights and
             liabilities of Course Provider will bind and inure to any assignees,
             administrators, successors, and executors.
         </p>
         <p>
             E) SEVERABILITY: If any part or sub-part of this Agreement is held invalid
             or unenforceable by a court of law or competent arbitrator, the remaining
             parts and sub-parts will be enforced to the maximum extent possible. In
             such conditions, the remainder of this Agreement shall continue in full
             force.
         </p>
         <p>
             F) NO WAIVER: In the event that we fail to enforce any provision of this
             Agreement, this shall not constitute a waiver of any future enforcement of
             that provision or of any other provision. Waiver of any part or sub-part of
             this Agreement will not constitute a waiver of any other part or sub-part.
         </p>
         <p>
             G) HEADINGS FOR CONVENIENCE ONLY: Headings of parts and sub-parts under
             this Agreement are for convenience and organisation, only. Headings shall
             not affect the meaning of any provisions of this Agreement.
         </p>
         <p>
             H) NO AGENCY, PARTNERSHIP, OR JOINT VENTURE: No agency, partnership, or
             joint venture has been created between the Parties as a result of this
             Agreement. No Party has any authority to bind the other to third parties.
         </p>
         <p>
             I) FORCE MAJEURE: We are not liable for any failure to perform due to
             causes beyond our reasonable control including, but not limited to, acts of
             God, acts of civil authorities, acts of military authorities, riots,
             embargoes, acts of nature, and natural disasters, and other acts which may
             be due to unforeseen circumstances.
         </p>
         <p>
             J) ELECTRONIC COMMUNICATIONS PERMITTED: Electronic communications are
             permitted to both Parties under this Agreement, including e-mail. For any
             questions or concerns, please email us at the following address:    <a href="mailto:info@nextlearnacademy.com">info@nextlearnacademy.com</a>.
         </p>

     </div>
     {{--<div class="container pt-50 pb-50">--}}
        {{--<p>THE AGREEMENT: This Course Agreement (hereinafter, "Agreement") is made by and between, a corporation, incorporated under the laws of England & Wales, hereinafter referred to as "Course Provider," and you, further defined below, as a participant in the Course, also defined below.</p>--}}
        {{--<p>All parts and sub-parts of this Agreement are specifically incorporated by reference here. This Agreement shall govern the use of all pages and screens in and on the Course and Products (all collectively referred to as "Course") and any services provided by or on this Course Provider through the Course ("Services") and/or on the Course Provider's website ("Website").</p>--}}

        {{--<h2 class="text-uppercasetext-theme-colored mt-0 mb-0 mt-sm-30">Your use of <span class="text-colored2">the--}}
                {{--website</span></h2>--}}
        {{--<p>You should not utilize this Website for anything that is unlawful or is generally restricted by these Terms--}}
            {{--of Service as well as any notification somewhere else on this Website.--}}
        {{--</p>--}}
        {{--<p>Next Learn Academy prompts that you look for proficient guidance before depending on any data on this Website.--}}
            {{--By no means will Next Learn Academy be at risk in any capacity for any data it gives on the Website or--}}
            {{--through the Services, including, however not constrained to, any mistakes or exclusions in any substance and--}}
            {{--data, including yet not restricted to message, programming, music, sound, photos, designs, video or other--}}
            {{--material (otherwise called "Content"), or any misfortune or harm of any sort brought about regarding--}}
            {{--utilization of or presentation to any Content posted, messaged, got to, sent, or in any case made accessible--}}
            {{--by means of the Services.--}}
        {{--</p>--}}

        {{--<h2>When utilizing this Website or the Services, you should not:--}}
        {{--</h2>--}}

        {{--<ol>--}}
            {{--<li>Stigmatize, misuse, bother, tail, compromise or in any case abuse the rights, (for example, privileges--}}
                {{--of security and exposure) of others</li>--}}
            {{--<li>Distribute, post, disperse or spread any slanderous, encroaching, vulgar, disgusting, hostile or--}}
                {{--unlawful material or data</li>--}}
            {{--<li>Transfer records that contain programming or other material secured by licensed innovation laws (or by--}}
                {{--privileges of protection of exposure) except if you own or control the rights or have gotten every--}}
                {{--single vital assent</li>--}}
            {{--<li>Transfer records that contain infections, undermined documents or some other comparative programming or--}}
                {{--projects that may harm the activity of another's PC</li>--}}
            {{--<li>Mimic any individual or substance, including without constraint any worker or agent of Company</li>--}}
            {{--<li>Post or send, or cause to be posted or sent, any correspondence or requesting structured or expected to--}}
                {{--acquire secret phrase, record, or private data from some other client of the Services</li>--}}
            {{--<li>Run Mail list, Listserv, any type of automated assistant, or "spam" on the Services, or any procedures--}}
                {{--that run or are actuated while you are not signed on to the Website, or that in any case meddle with or--}}
                {{--place an irrational burden on the Services' foundation or any outsider sites or administrations</li>--}}
            {{--<li>Decompile, figure out, or in any case endeavor to acquire the source code of the Services</li>--}}
            {{--<li>Erase any creator attributions, lawful notification or exclusive assignments or names in any document--}}
                {{--that is transferred</li>--}}
            {{--<li>Adulterate the starting point or wellspring of programming or other material contained in a document--}}
                {{--that is transferred</li>--}}
            {{--<li>Promote or offer to sell any merchandise or administrations or lead or forward reviews, rivalries, or--}}
                {{--junk letters, or request gifts; or</li>--}}
            {{--<li>Download any document posted by another client of this Website that you know, or sensibly should know,--}}
                {{--can't be lawfully appropriated in such way</li>--}}
            {{--<li>You will be liable for retaining, documenting, and detailing all charges, obligations and other--}}
                {{--administrative appraisals, assuming any, related with your movement regarding the Services.</li>--}}
        {{--</ol>--}}

        {{--<h2>You speak to and warrant Next Learn Academy that you are of legitimate age to frame a coupling contract or--}}
            {{--have the assent of your parent or gatekeeper to do as such. You likewise affirm that you are legitimately--}}
            {{--allowed to utilize and get to the Services and assume full liability for the choice and utilization of and--}}
            {{--access to the Services. This understanding is void where disallowed by law, and the option to get to the--}}
            {{--Services is denied in such purviews.--}}
        {{--</h2>--}}
        {{--<h2>On the off chance that you are enrolling with the Website as a business substance, you speak to that you--}}
            {{--have the position to lawfully tie that element and agree to impart any representative data to Next Learn Academy. On the off chance that you are exchanging as a business, you should conform to and you are liable--}}
            {{--for all laws material to your business.--}}
        {{--</h2>--}}
        {{--<h2>On the off chance that you connect to the Website, Next Learn Academy may deny your entitlement to so--}}
            {{--interface whenever, at Next Learn Academy's sole tact. Organization maintains whatever authority is needed to--}}
            {{--require earlier composed agree before connecting to the Website.--}}
        {{--</h2>--}}
        {{--<h2>You will reimburse and hold Next Learn Academy, its folks, auxiliaries, associates, officials, and--}}
            {{--representatives innocuous (counting, without restriction, from all harms, liabilities, settlements, expenses--}}
            {{--and lawyers' charges) from any case or request made by any outsider due to or emerging out of your or your--}}
            {{--workers' entrance to the Services, utilization of the Services, your infringement of these Terms of Service--}}
            {{--, or the encroachment by you or any outsider utilizing your record of any protected innovation or other--}}
            {{--right of any individual or element.--}}
        {{--</h2>--}}
    {{--</div>--}}
</section>

 <!--=========== END T&C Banner ===========-->

@stop




@section('footer_scripts')
    @toastr_js
    @toastr_render

@stop