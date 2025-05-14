<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Visitor Sign-In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .signature-pad {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            width: 100%;
            height: 150px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">LogiVisit</a>
        </div>
    </nav>

    <div class="container">
        <div class="card mx-auto" style="max-width: 480px;">
            <div class="card-body">
                <h5 class="card-title text-primary">Visitor Sign-In</h5>
                <p class="card-text">Please fill in your details and sign below.</p>
                <form method="post" action="/visitor/signin" onsubmit="return saveSignature()">
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="e.g. Jane Doe" required />
                    </div>
                    <div class="mb-3">
                        <label for="institution" class="form-label">Institution / Company</label>
                        <input type="text" class="form-control" id="institution" name="institution" placeholder="e.g. Example Corp" required />
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Department / Purpose of Visit</label>
                        <input type="text" class="form-control" id="department" name="department" placeholder="e.g. Marketing / Meeting" required />
                    </div>
                    <div class="mb-3">
                        <label for="datetime_in" class="form-label">Date &amp; Time In</label>
                        <input type="text" class="form-control" id="datetime_in" name="datetime_in" readonly />
                        <small class="form-text text-muted">Current time is automatically recorded.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Signature</label>
                        <canvas id="signature-pad" class="signature-pad"></canvas>
                        <input type="hidden" name="signature" id="signature" />
                        <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="clearSignature()">Clear Signature</button>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Sign In</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script>
        const canvas = document.getElementById('signature-pad');
        const signaturePad = new SignaturePad(canvas);

        function resizeCanvas() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext('2d').scale(ratio, ratio);
            signaturePad.clear();
        }

        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();

        function clearSignature() {
            signaturePad.clear();
        }

        function saveSignature() {
            if (signaturePad.isEmpty()) {
                alert('Please provide a signature.');
                return false;
            }
            const dataUrl = signaturePad.toDataURL();
            document.getElementById('signature').value = dataUrl;
            return true;
        }

        // Set current datetime in the datetime_in input
        function setCurrentDateTime() {
            const now = new Date();
            const formatted = now.toLocaleString('en-US', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
            document.getElementById('datetime_in').value = formatted;
        }
        setCurrentDateTime();
    </script>
</body>
</html>
