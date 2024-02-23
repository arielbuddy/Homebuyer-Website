<?php

/*******************************************************************************
 * CHARTS
 */

function homebuyer_chart_shortcode($atts = [], $content = null) {
    if (!isset($atts['id'])) {
        return 'Error: The "id" parameter is required.';
    }

    return '
        <script type="text/javascript">
            jQuery(window).on("load",function () {
                if (typeof wpDataChartsCallbacks === "undefined") {
                    wpDataChartsCallbacks = {};
                }
                wpDataChartsCallbacks[' . $atts['id'] . '] = function (cfg) {
                    cfg.options.options.animation = false;
                    // cfg.options.options.layout.padding = 20; // why u no work?
                    cfg.options.options.plugins.title.font.size = 24;
                    cfg.options.options.plugins.title.font.family = "tiempos";
                    cfg.options.options.plugins.title.position = "top";
                    cfg.options.options.plugins.title.align = "start";
                    cfg.options.options.plugins.title.padding = { top: 10, bottom: 30 };
                    cfg.options.options.plugins.legend.position = "bottom";
                    cfg.options.options.plugins.legend.labels.font.size = 12;
                    cfg.options.options.plugins.legend.labels.font.family = "circular";
                    cfg.options.options.plugins.tooltip.enabled = false;
                    cfg.options.options.scales.x.ticks.font.size = 14;
                    cfg.options.options.scales.x.ticks.font.family = "circular";
                    cfg.options.options.scales.x.title.font.size = 12;
                    cfg.options.options.scales.x.title.font.weight = "normal";
                    cfg.options.options.scales.x.title.font.family = "circular";
                    cfg.options.options.scales.y.ticks.font.size = 14;
                    cfg.options.options.scales.y.ticks.font.family = "circular";
                    cfg.options.options.scales.y.ticks.callback = (value) => {
                        if (value >= 1000000) {
                            return (value / 1000000).toFixed(1) + "MM";
                        } else if (value >= 100000) {
                            return (value / 1000).toFixed(0) + "k";
                        }
                        return new Intl.NumberFormat().format(value);
                    };
                    cfg.options.options.scales.y.title.font.size = 12;
                    cfg.options.options.scales.y.title.font.weight = "normal";
                    cfg.options.options.scales.y.title.font.family = "circular";

                    const HB_COLORS = ["#5462D1", "#009BFF", "#F4867A", "#DDDD00", "#0BB280", "#AB91C5", "#4C4C4C"];
                    cfg.options.data.datasets.forEach((dataset, i) => {
                        dataset.backgroundColor = HB_COLORS[i % HB_COLORS.length];
                        dataset.borderColor = HB_COLORS[i % HB_COLORS.length];
                        if (cfg.options.type === "line") {
                            dataset.borderWidth = 3;
                        }
                    });
                }
            });
        </script>
        <div class="bg-brand-white py-2.5 px-7 mb-5">
            <div class="mb-12">' . $content . '</div>
            ' . do_shortcode("[wpdatachart id='{$atts['id']}']") . '
            <div class="flex justify-between items-center">
                <p class="!text-xs pt-5 text-[#888]">
                    Data: FFEIC / Source: Homebuyer.com HMDA Mortgage Data Study <br/>
                    Methodology at https://homebuyer.com/learn/hmda-mortgage-statistics
                </p>
                <img class="w-12 aspect-square" src="/wp-content/uploads/2022/04/Homebuyer-Logo-Avatar-Transparent.png" alt="Homebuyer.com Logo" title="Homebuyer.com Logo">
            </div>
        </div>
    ';
}
add_shortcode( 'homebuyer_chart', 'homebuyer_chart_shortcode' );
