<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Share Certificate</title>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}" />
  <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}" />
  <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}" />

  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Crimson+Text&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Crimson Text', serif;
      background: #f4f6f8;
      margin: 0;
      padding: 0;
      display: block;
    }

    .certificate-container {
      width: 297mm;
      height: 210mm;
      padding: 30mm;
      margin: auto;
      background-color: #fff; /* Fallback background color */
      border: 12px double #1e3a8a;
      box-sizing: border-box;
      position: relative;

      background-image: linear-gradient(rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.88)), url("{{ asset('logo.png') }}");
      background-repeat: no-repeat;
      /* --- MODIFICATION: Changed position to move the logo upwards --- */
      background-position: center 50%;
      background-size: 1500px; /* Adjust size as needed */
    }

    .certificate-title {
      font-family: 'Dancing Script', cursive;
      font-size: 48px;
      font-weight: 700;
      text-align: center;
      margin-bottom: 10px;
      color: #1e3a8a;
      letter-spacing: 2px;
    }

    .certificate-subtitle {
      text-align: center;
      font-size: 14px;
      color: #555;
      margin-bottom: 30px;
      text-transform: uppercase;
    }

    .holder-name {
      font-size: 26px;
      font-weight: 600;
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    .certificate-text,
    .articles-text {
      text-align: center;
      font-size: 16px;
      color: #555;
      margin-bottom: 20px;
    }

    .project-info {
      text-align: center;
      margin-bottom: 20px;
    }

    .project-info strong {
      color: #2c3e50;
    }

    .share-details {
      display: flex;
      justify-content: center;
      gap: 100px;
      margin: 30px 0;
    }

    .share-block {
      text-align: center;
    }

    .share-label {
      font-weight: 600;
      font-size: 14px;
      color: #555;
    }

    .share-value {
      font-size: 22px;
      font-weight: bold;
      color: #1e3a8a;
    }

    .issue-date {
      text-align: right;
      font-size: 14px;
      margin-top: 40px;
      color: #666;
    }

    .footer-note {
      text-align: center;
      font-size: 13px;
      color: #888;
      margin-top: 50px;
      font-style: italic;
    }

    .download-btn {
      position: absolute;
      top: 20px;
      right: 20px;
      background-color: #1e3a8a;
      color: white;
      padding: 10px 18px;
      border: none;
      border-radius: 4px;
      font-size: 14px;
      cursor: pointer;
      z-index: 10;
    }

    .download-btn:hover {
      background-color: #1e40af;
    }

    @media print {
      body {
        background: #fff;
        padding: 0;
      }

      .certificate-container {
        border-radius: 0;
        box-shadow: none;
      }

      .download-btn {
        display: none;
      }
    }

    @media screen and (max-width: 1000px) {
      .certificate-container {
        transform: scale(0.8);
        transform-origin: top left;
      }
    }
  </style>
</head>
<body>
  <button class="download-btn" onclick="downloadCertificate()">Download Certificate</button>

  <div class="certificate-container" id="certificate">

    <div class="certificate-title">
      <h1>Share Certificate</h1>
    </div>
    <div class="certificate-subtitle">Official Document of Ownership</div>

    <div class="holder-name">{{ ucfirst($data['name']) }}</div>

    <div class="certificate-text">
      is the registered holder of the following shares each fully paid in the company:
    </div>

    <div class="project-info">
      <div><strong>Property:</strong> {{ $data['propertyName'] }}</div>
    </div>

    <div class="articles-text">
      subject to the Articles of Association of the Company
    </div>

    <div class="share-details">
      <div class="share-block">
        <div class="share-label">Quantity</div>
        <div class="share-value">{{ number_format($data['token_count'], 2) }}</div>
      </div>
    </div>

    <div class="issue-date">
      <strong>Date of Issue:</strong> {{ \Carbon\Carbon::parse($data['created_at'])->format('d M Y') }}
    </div>


    <div class="footer-note">
      Authorized by Tokeneasy.io
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script>
    async function downloadCertificate() {
      const element = document.getElementById('certificate');
      const downloadBtn = document.querySelector('.download-btn');

      try {
        downloadBtn.style.display = 'none';
        downloadBtn.textContent = 'Generating PDF...';
        await document.fonts.ready;

        const canvas = await html2canvas(element, {
          scale: 2,
          useCORS: true,
          allowTaint: true,
          backgroundColor: '#ffffff',
          logging: false
        });

        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF({
          orientation: 'landscape',
          unit: 'mm',
          format: 'a4'
        });

        const imgWidth = 297;
        const pageHeight = 210;
        const imgHeight = (canvas.height * imgWidth) / canvas.width;

        const imgData = canvas.toDataURL('image/jpeg', 1.0);
        pdf.addImage(imgData, 'JPEG', 0, 0, imgWidth, imgHeight);

        pdf.save('Share-Certificate.pdf');
      } catch (error) {
        console.error('Error generating PDF:', error);
        alert('Error generating PDF. Please try again.');
      } finally {
        downloadBtn.style.display = 'block';
        downloadBtn.textContent = 'Download Certificate';
      }
    }
  </script>
</body>
</html>