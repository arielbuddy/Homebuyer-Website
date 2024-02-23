<?php
  [ 'content' => $content ] = $args;

  $dom = new DOMDocument();
  libxml_use_internal_errors(true);
  $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
  libxml_clear_errors();

  $h2s = [];
  foreach ($dom->getElementsByTagName('h2') as $element) {
    $h2s[] = $element->textContent;
  }
?>
<?php if (count($h2s)) { ?>
  <!-- Div to set up the floating -->
  <div data-toc class="hidden sticky top-20 justify-end pb-24">
    <!-- Floating TOC -->
    <div class="overflow-hidden relative w-60 flex flex-col justify-center py-4 px-5">
      <div class="w-full text-lg whitespace-nowrap font-serif text-brand-black mb-4">
        Table of Contents
      </div>

      <?php foreach ($h2s as $i => $h2) { ?>
        <div data-toc-item class="border-l border-brand-gray pl-4 py-2">
          <span class="hidden absolute left-2 -mt-2 text-3xl font-sans-medium !text-brand-purple mdi mdi-menu-right"></span>
          <a class="text-sm !text-brand-gray-dark !no-underline block hover:!text-brand-black" href="#toc-<?php echo ($i + 1); ?>"><?php echo $h2; ?></a>
        </div>
      <?php } ?>

      <div data-toc-item class="border-l border-brand-gray pl-4 py-2">
        <span class="hidden absolute left-2 -mt-2 text-3xl font-sans-medium !text-brand-purple mdi mdi-menu-right"></span>
        <a class="text-sm !text-brand-gray-dark !no-underline block hover:!text-brand-black" data-action="Click" data-category="Pre-approval" data-label="article-floating-toc" href="https://app.homebuyer.com" target="_blank">Get A Mortgage Pre-Approval</a>
      </div>
    </div>
  </div>
<?php } ?>
