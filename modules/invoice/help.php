<?php include_once "../../includes/header.php"; ?>

<style>
:root {
    --primary-color: #1a56db;
    --secondary-color: #4b5563;
    --background-color: #f9fafb;
    --border-color: #e5e7eb;
    --text-color: #111827;
    --hover-color: #1e40af;
    --accent-color: #3b82f6;
}

:root[data-theme="dark"] {
    --primary-color: #60a5fa;
    --secondary-color: #9ca3af;
    --background-color: #111827;
    --border-color: #374151;
    --text-color: #f9fafb;
    --hover-color: #3b82f6;
    --accent-color: #60a5fa;
}

header,.fff {
    background-color: var(--background-color) !important;
}

article.inside-info {
    margin-top: 20px;
}

button.btn {
    margin: 3px 0;
}

p.fw-normal {
    margin-bottom: 5px;
}

section {
    margin-bottom: 10px;
}

article {
    margin-bottom: 5px;
}
</style>

<div class="border my-4 mx-auto p-4 rounded-3 fff" style="width: 90%;">

        <p class="fw-bold fs-4 d-flex align-items-center">
                <button class="btn border mx-2">
                        <a href="create.php" class="text-secondary text-decoration-none"><i class="fa-solid fa-arrow-left fs-6 text-secondary fw-bold"></i></a>
                </button> Help
        </p>

        <p class="fw-normal text-secondary my-5" style="font-size: 18px; width: 93%;">Invoice Generator provides an
                invoice template that lets you make professional invoices in one-click. Generated invoices can be sent
                and paid online.
        </p>


        <section class="why">
                <p class="fs-4 fw-bold pb-2 border-bottom">
                        Why use Invoice Generator?
                </p>

                <ol>
                        <li class="text-secondary"><span class="li_header font fs-6 fw-bold text-bold d-block">Instant
                                        Invoice</span><span class="li_body">We have developed the fastest way to make an
                                        invoice using our
                                        invoice template. You can make and download an invoice without creating account.
                                        If you want to send your invoice it is only one button press away from
                                        delivering an e-invoice to your client.
                                </span></li>
                        <li class="text-secondary"><span class="li_header font fs-6 fw-bold text-bold d-block">Invoice
                                        from any device
                                </span><span class="li_body">Invoice on-the-go from any device, desktop, tablet, or
                                        smartphone.

                                </span></li>
                        <li class="text-secondary"><span class="li_header font fs-6 fw-bold text-bold d-block">Trusted
                                        by millions</span><span class="li_body">Every month millions of invoices are
                                        generated on Invoice
                                        Generator.

                                </span></li>
                        <li class="text-secondary"><span class="li_header font fs-6 fw-bold text-bold d-block">100%
                                        FREE</span><span class="li_body">There are no limits. Use it as much as you
                                        like.
                                </span></li>
                </ol>

                <p class="fw-normal fs-6 text-secondary my-5">Our objective at
                        Invoice-Generator.com is to make invoicing as simple as possible. We built this invoice
                        generator solely dedicated to this purpose. We want to give you the best possible invoicing
                        experience, and hope it saves you from the many frustrations that come with invoicing.
                </p>
        </section>


        <section class="how">
                <p class="fs-4 fw-bold pb-2 border-bottom">
                        How do I use Invoice Generator?
                </p>

                <div class="how-content">
                        <article class="info">
                                <p class="fs-5 fw-bold"> Making Invoices </p>

                                <p class="fw-normal fs-6 text-secondary">Generating invoices is easy! Fill out the
                                        invoice
                                        template with all the details you want on your invoice. The invoice editor
                                        closely
                                        matches what the resulting invoice will look like. Once you have filled in the
                                        invoice
                                        template you are ready to download or send your invoice.
                                </p>
                                <p class="fw-normal fs-6 text-secondary"> <span style="margin-right: 2px;"><i
                                                        class="fa-solid fa-circle-info"></i></span> The download
                                        invoice button will be disabled until you fill in your information and your
                                        client's
                                        information into the to/from fields.
                                </p>
                        </article>

                        <article class="info">
                                <p class="fs-5 fw-bold"> Sending Invoices </p>

                                <p class="fw-normal fs-6 text-secondary">Invoices can be sent to customers with an
                                        Invoice-Generator.com account. Your invoices are stored securely in the cloud,
                                        and you can accept a variety of payment methods that are convenient for your
                                        customer.
                                </p>

                                <button class="btn btn-sm btn-primary py-2 px-3">Learn More</button>

                                <article class="inside-info">
                                        <p class="fs-6 fw-bold"> Payments </p>
                                        <p class="fw-normal fs-6 text-secondary">If you are using the send invoice
                                                feature, you can accept bank account and credit/debit card payments from
                                                your buyer. You are also able to add payment instructions to your
                                                invoice if you want to accept alternative payment methods.
                                        </p>
                                </article>
                        </article>

                        <article class="info">
                                <p class="fs-5 fw-bold"> Downloading Invoices </p>

                                <p class="fw-normal fs-6 text-secondary">Click the <span class="fw-bold"> Download
                                                Invoice </span> to download a PDF of your invoice. If you made a
                                        mistake, don't worry, you can go back and update the invoice by clicking <span
                                                class="fw-bold"> Edit this invoice </span>. If you do not see your
                                        invoice once you click download then you should check your Downloads folder.
                                </p>

                                <article class="inside-info">
                                        <p class="fs-6 fw-bold"> Saving Invoices </p>
                                        <p class="fw-normal fs-6 text-secondary">Invoices that you download or send are
                                                auto-saved to your device's local storage. This allows you to go back
                                                and edit past invoices.
                                        </p>
                                        <p class="fw-normal fs-6 text-secondary">You can access past invoices on the
                                                <a href="history.php" class="text-success text-decoration-none"> History
                                                </a>page. Click on a previously generated invoice to open it in the
                                                invoice editor. You can also export all of your invoices to a
                                                spreadsheet file by clicking the <span class="fw-bold"> Export </span>
                                                button.
                                        </p>
                                        <p class="fw-normal fs-6 text-secondary">Individual invoices can be deleted by
                                                hovering over the invoice and clicking the <span class="fw-bold"> X
                                                </span> button. Clicking <span class="fw-bold"> Erase
                                                        Everything </span> will erase all saved invoices and any
                                                customizations to the
                                                invoice template.
                                        </p>
                                </article>
                        </article>

                        <article class="info">
                                <p class="fs-5 fw-bold"> Customizing the Invoice Template </p>

                                <p class="fw-normal fs-6 text-secondary">If you find yourself using Invoice Generator
                                        often, you can memorize your invoice template customizations. Just click Save
                                        Template in the right sidebar after you have finished customizing your invoice
                                        template. Now every time you use Invoice Generator your personalized invoice
                                        template will be loaded.
                                </p>

                                <p class="fw-normal fs-6 text-secondary">The invoice template will remember your: </p>

                                <ul>
                                        <li class="text-secondary"><span class="li_header font fs-6 d-block">From
                                                        address</span>
                                        </li>
                                        <li class="text-secondary"><span class="li_header font fs-6 d-block">Logo
                                                </span>
                                        </li>
                                        <li class="text-secondary"><span
                                                        class="li_header font fs-6 d-block">Currency</span>
                                        </li>
                                        <li class="text-secondary"><span
                                                        class="li_header font fs-6 d-block">Terms</span>
                                        </li>
                                        <li class="text-secondary"><span
                                                        class="li_header font fs-6 d-block">Notes</span>
                                        </li>
                                        <li class="text-secondary"><span class="li_header font fs-6 d-block">Field
                                                        Titles</span>
                                        </li>
                                </ul>

                        </article>

                        <article class="info">
                                <p class="fs-5 fw-bold"> System Requirements </p>

                                <p class="fw-normal fs-6 text-secondary">In order to use Invoice Generator you must use
                                        one of the following web browsers:
                                </p>

                                <ul>
                                        <li class="text-secondary"><span class="li_header font fs-6 d-block">Google
                                                        Chrome: latest two versions
                                                </span>
                                        </li>
                                        <li class="text-secondary"><span class="li_header font fs-6 d-block">Mozilla
                                                        Firefox: latest two versions

                                                </span>
                                        </li>
                                        <li class="text-secondary"><span class="li_header font fs-6 d-block">Apple
                                                        Safari: latest two versions
                                                </span>
                                        </li>
                                        <li class="text-secondary"><span class="li_header font fs-6 d-block">Microsoft
                                                        Edge: latest two versions
                                                </span>
                                        </li>
                                        <li class="text-secondary"><span class="li_header font fs-6 d-block">Internet
                                                        Explorer 11
                                                </span>
                                        </li>
                                </ul>

                                <p class="fw-normal fs-6 text-secondary">Your browser must also have this configuration
                                        which any supported browser has out of the box:
                                </p>

                                <ul>
                                        <li class="text-secondary"><span class="li_header font fs-6 d-block">Javascript
                                                        enabled
                                                </span>
                                        </li>
                                        <li class="text-secondary"><span class="li_header font fs-6 d-block">Local
                                                        storage enabled
                                                </span>
                                        </li>
                                        <li class="text-secondary"><span class="li_header font fs-6 d-block">TLS v1.2 or
                                                        above
                                                </span>
                                        </li>
                                </ul>

                        </article>
                </div>
        </section>

        <section class="where">
                <p class="fs-4 fw-bold pb-2 border-bottom">
                        Where does Invoice Generator store invoices?
                </p>

                <div class="where-content">
                        <article class="info">
                                <p class="fs-5 fw-bold"> Send Invoice feature </p>

                                <p class="fw-normal fs-6 text-secondary">If you have used the Send Invoice option then
                                        you or your recipient can retrieve the invoice at any time by signing in to
                                        Invoice-Generator.com.
                                </p>

                        </article>

                        <article class="info">
                                <p class="fs-5 fw-bold"> Download Invoice feature </p>

                                <p class="fw-normal fs-6 text-secondary">Invoice Generator uses your web browser's local
                                        storage to remember your invoices without requiring you to create an account
                                        with us. We do not maintain any copies of your downloaded invoice on our
                                        servers. Clearing your browser history will clear all of your invoices on
                                        Invoice Generator and they cannot be recovered.
                                </p>

                                <p class="fw-normal fs-6 text-secondary">If you use the Download Invoice option then
                                        please keep a backup of each invoice PDF you create, or use an
                                        Invoice-Generator.com account to store and send your invoice.
                                </p>
                        </article>
                </div>

        </section>

        <section class="new">
                <p class="fs-4 fw-bold pb-2 border-bottom">
                        What's new?
                </p>

                <p class="fw-normal fs-6 text-secondary">Read the Release Notes to see the latest invoicing features
                        we've added.
                </p>
        </section>


        <section class="api mb-5">
                <p class="fs-4 fw-bold pb-2 border-bottom">
                        Invoice Generator API
                </p>

                <p class="fw-normal fs-6 text-secondary">Save yourself the hassle of setting up an invoice template and
                        all of the frustration associated with generating PDFs. Our service gives you a clean interface
                        for quick, attractive invoices generated from your code.
                </p>

                <button class="btn btn-sm btn-primary py-2 px-3">API Documentation</button>

        </section>

</div>

<?php include_once "../../includes/footer.php"; ?>