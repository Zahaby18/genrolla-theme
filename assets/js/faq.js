/**
 * Genrolla — FAQ accordion behaviour
 *
 * Exclusive accordion: only one item can be open at a time, with a smooth
 * height animation on open and close. Built on native <details> markup so the
 * accordion keeps working (and stays accessible) when JavaScript is disabled.
 *
 * Open state is tracked internally so the behaviour does not depend on the
 * browser's default details/summary toggle timing.
 */
(function () {
    'use strict';

    var DURATION = 320;
    var EASING = 'cubic-bezier(.4, 0, .2, 1)';

    function init() {
        var root = document.getElementById('genrolla-faq');
        if (!root) {
            return;
        }

        var items = Array.prototype.slice.call(root.querySelectorAll('details.faq-item'));
        if (!items.length) {
            return;
        }

        var reduceMotion = false;
        if (typeof window.matchMedia === 'function') {
            reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        }

        var timers = new WeakMap();

        function panelOf(item) {
            return item.querySelector('.faq-answer');
        }

        function clearTimer(item) {
            var t = timers.get(item);
            if (t) {
                window.clearTimeout(t);
                timers.delete(item);
            }
        }

        function resetStyles(panel) {
            panel.style.transition = '';
            panel.style.height = '';
            panel.style.overflow = '';
        }

        function isOpen(item) {
            return item.getAttribute('data-faq-state') === 'open';
        }

        function setState(item, state) {
            item.setAttribute('data-faq-state', state);
            item.open = 'open' === state;
        }

        function openItem(item) {
            if (isOpen(item)) {
                return;
            }

            // Exclusive: close every other open item first.
            items.forEach(function (other) {
                if (other !== item && isOpen(other)) {
                    closeItem(other);
                }
            });

            var panel = panelOf(item);
            setState(item, 'open');

            if (!panel) {
                return;
            }

            if (reduceMotion) {
                resetStyles(panel);
                return;
            }

            clearTimer(item);
            panel.style.overflow = 'hidden';
            panel.style.height = '0px';
            void panel.offsetHeight; // force reflow

            var target = panel.scrollHeight;
            panel.style.transition = 'height ' + DURATION + 'ms ' + EASING;
            panel.style.height = target + 'px';

            timers.set(item, window.setTimeout(function () {
                resetStyles(panel);
                timers.delete(item);
            }, DURATION));
        }

        function closeItem(item) {
            var panel = panelOf(item);
            if (!isOpen(item)) {
                return;
            }

            if (!panel || reduceMotion) {
                setState(item, 'closed');
                if (panel) {
                    resetStyles(panel);
                }
                return;
            }

            clearTimer(item);
            panel.style.overflow = 'hidden';
            panel.style.height = panel.scrollHeight + 'px';
            void panel.offsetHeight; // force reflow

            panel.style.transition = 'height ' + DURATION + 'ms ' + EASING;
            panel.style.height = '0px';

            timers.set(item, window.setTimeout(function () {
                setState(item, 'closed');
                resetStyles(panel);
                timers.delete(item);
            }, DURATION));
        }

        // Register state and listeners.
        items.forEach(function (item) {
            var summary = item.querySelector('summary');

            setState(item, item.open ? 'open' : 'closed');

            // Keep internal state in sync if something else toggles the element.
            item.addEventListener('toggle', function () {
                if (timers.has(item)) {
                    return; // our own animation is in flight
                }
                setState(item, item.open ? 'open' : 'closed');
            });

            if (!summary) {
                return;
            }

            summary.addEventListener('click', function (event) {
                event.preventDefault();
                if (isOpen(item)) {
                    closeItem(item);
                } else {
                    openItem(item);
                }
            });
        });

        // Normalise the initial state: keep only the first item open.
        var openItems = items.filter(function (item) {
            return isOpen(item);
        });
        if (openItems.length > 1) {
            openItems.slice(1).forEach(function (item) {
                setState(item, 'closed');
                var p = panelOf(item);
                if (p) {
                    resetStyles(p);
                }
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
