<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Viewer</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            padding: 1.5rem 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: white;
        }

        .header-left h1 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .back-btn {
            background: none;
            border: none;
            color: #6366f1;
            font-size: 1.25rem;
            cursor: pointer;
            transition: color 0.3s ease;
            padding: 0.5rem;
        }

        .back-btn:hover {
            color: #818cf8;
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        .download-btn {
            background: #6366f1;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .download-btn:hover {
            background: #818cf8;
        }

        .pdf-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            overflow: auto;
        }

        .pdf-viewer {
            max-width: 100%;
            height: 100%;
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .error-message {
            color: #ef4444;
            text-align: center;
            padding: 2rem;
            background: rgba(239, 68, 68, 0.1);
            border-radius: 0.5rem;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        @media (max-width: 768px) {
            header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .header-left {
                width: 100%;
            }

            .download-btn {
                width: 100%;
                justify-content: center;
            }

            .file-info {
                font-size: 0.8rem;
            }

            .pdf-container {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-left">
            <a class="back-btn" href="{{ url('/') }}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1>PDF Viewer</h1>
        </div>
        <div class="file-info">
            <span id="fileName">Document</span>
            <button class="download-btn" onclick="downloadPDF()">
                <i class="fas fa-download"></i>
                Download
            </button>
        </div>
    </header>

    <div class="pdf-container">
        <embed id="pdfViewer" class="pdf-viewer" type="application/pdf">
    </div>

    <script>
        // Get PDF URL from query parameter or localStorage
        function getPDFUrl() {
            const params = new URLSearchParams(window.location.search);
            const url = params.get('pdf');
            
            if (url) {
                return decodeURIComponent(url);
            }
            
            // Fallback to localStorage if available
            const storedPDF = localStorage.getItem('currentPDF');
            return storedPDF || '';
        }

        // Load PDF on page load
        window.addEventListener('load', function() {
            const pdfUrl = getPDFUrl();
            
            if (pdfUrl) {
                document.getElementById('pdfViewer').src = pdfUrl;
                
                // Extract filename from URL or use default
                const filename = pdfUrl.split('/').pop().split('?')[0] || 'document.pdf';
                document.getElementById('fileName').textContent = filename;
            }
        });

        // Go back to previous page
        function goBack() {
            window.history.back();
        }

        // Download PDF
        function downloadPDF() {
            const pdfUrl = getPDFUrl();
            if (pdfUrl) {
                const link = document.createElement('a');
                link.href = pdfUrl;
                link.download = document.getElementById('fileName').textContent || 'document.pdf';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }
    </script>
</body>
</html>