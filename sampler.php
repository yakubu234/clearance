

<!DOCTYPE html>
<!--
Copyright 2016 Mozilla Foundation

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
-->
<html dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title>PDF.js viewer</title>

    <link rel="stylesheet" href="../../node_modules/pdfjs-dist/web/pdf_viewer.css">
    <link rel="stylesheet" type="text/css" href="viewer.css">

    <script src="../../node_modules/pdfjs-dist/build/pdf.js"></script>
    <script src="../../node_modules/pdfjs-dist/web/pdf_viewer.js"></script>
  </head>

  <body>
    <header>
      <h1 id="title"></h1>
    </header>

    <div id="viewerContainer">
      <div id="viewer" class="pdfViewer"></div>
    </div>

    <div id="loadingBar">
      <div class="progress"></div>
      <div class="glimmer"></div>
    </div>

    <div id="errorWrapper" hidden="true">
      <div id="errorMessageLeft">
        <span id="errorMessage"></span>
        <button id="errorShowMore">
          More Information
        </button>
        <button id="errorShowLess">
          Less Information
        </button>
      </div>
      <div id="errorMessageRight">
        <button id="errorClose">
          Close
        </button>
      </div>
      <div class="clearBoth"></div>
      <textarea id="errorMoreInfo" hidden="true" readonly="readonly"></textarea>
    </div>

    <footer>
      <button class="toolbarButton pageUp" title="Previous Page" id="previous"></button>
      <button class="toolbarButton pageDown" title="Next Page" id="next"></button>

      <input type="number" id="pageNumber" class="toolbarField pageNumber" value="1" size="4" min="1">

      <button class="toolbarButton zoomOut" title="Zoom Out" id="zoomOut"></button>
      <button class="toolbarButton zoomIn" title="Zoom In" id="zoomIn"></button>
    </footer>

     <script src="viewer.js"></script>
  </body>
</html>
