(function () {
    var tabs = document.querySelectorAll(".limo-tab");
    var panels = document.querySelectorAll(".limo-panel");
    if (!tabs.length || !panels.length) return;

    var activeBorder = "#1f2937";
    var inactiveBorder = "transparent";

    function setTab(id) {
        tabs.forEach(function (t) {
            var on = t.getAttribute("data-tab") === id;
            t.setAttribute("aria-selected", on ? "true" : "false");
            t.classList.toggle("text-gray-900", on);
            t.classList.toggle("font-semibold", on);
            t.classList.toggle("text-gray-600", !on);
            t.style.borderBottomColor = on ? activeBorder : inactiveBorder;
        });
        panels.forEach(function (p) {
            var match = p.getAttribute("data-panel") === id;
            p.classList.toggle("hidden", !match);
            p.hidden = !match;
        });
        if (typeof AOS !== "undefined") {
            requestAnimationFrame(function () {
                AOS.refresh();
            });
        }
    }

    tabs.forEach(function (tab) {
        tab.addEventListener("click", function () {
            setTab(tab.getAttribute("data-tab"));
        });
    });

    var defTab =
        typeof window.LIMO_DEFAULT_TAB === "string" && window.LIMO_DEFAULT_TAB
            ? window.LIMO_DEFAULT_TAB
            : "airport";
    var defBtn = document.querySelector('.limo-tab[data-tab="' + defTab + '"]');
    if (defBtn) {
        setTab(defTab);
    } else {
        var firstTab = document.querySelector(".limo-tab");
        if (firstTab) {
            setTab(firstTab.getAttribute("data-tab"));
        }
    }

    var pickupSelect = document.querySelector("#airport-pickup-location-id");
    var destSelect = document.querySelector("#airport-destination-location-id");
    var swapBtn = document.getElementById("airport-swap");
    if (swapBtn && pickupSelect && destSelect) {
        swapBtn.addEventListener("click", function () {
            var a = pickupSelect.value;
            var b = destSelect.value;
            pickupSelect.value = b;
            refillLinkedDestinationSelect(destSelect, pickupSelect.value, "airport");
            if (b && destSelect.querySelector('option[value="' + b + '"]')) {
                destSelect.value = b;
            }
            pickupSelect.dispatchEvent(new Event("change", { bubbles: true }));
            destSelect.dispatchEvent(new Event("change", { bubbles: true }));
        });
    }

    var defaultCityPrices = { "3": 515, "6": 920, "8": 1180, "12": 1650 };
    var prices =
        typeof window.LIMO_CITY_PRICES === "object" && window.LIMO_CITY_PRICES !== null
            ? Object.assign({}, defaultCityPrices, window.LIMO_CITY_PRICES)
            : defaultCityPrices;
    var cityRouteRules =
        typeof window.LIMO_CITY_ROUTE_RULES === "object" && window.LIMO_CITY_ROUTE_RULES !== null
            ? window.LIMO_CITY_ROUTE_RULES
            : [];
    var cityPriceMsgs =
        typeof window.LIMO_PRICE_MESSAGES === "object" && window.LIMO_PRICE_MESSAGES !== null
            ? window.LIMO_PRICE_MESSAGES
            : { unavailable: "—", noTier: "—" };
    var labels = {
        "3": "3 Hours",
        "6": "6 Hours",
        "8": "8 Hours",
        "12": "12 Hours (Full Day)"
    };

    var LIMO_GLOBAL_MAX_PASSENGERS =
        typeof window.LIMO_GLOBAL_MAX_PASSENGERS === "number" && window.LIMO_GLOBAL_MAX_PASSENGERS > 0
            ? window.LIMO_GLOBAL_MAX_PASSENGERS
            : 50;

    /** Tightest passenger cap among matched routes (each route uses last price group's "To" in admin). */
    function limoCapsFromRoutes(routes) {
        if (!routes || !routes.length) {
            return LIMO_GLOBAL_MAX_PASSENGERS;
        }
        var caps = routes.map(function (r) {
            var m = r.max_pax;
            if (m == null || isNaN(m) || m < 1) {
                return LIMO_GLOBAL_MAX_PASSENGERS;
            }
            return Number(m);
        });
        return Math.min.apply(null, caps);
    }

    function applyCityPaxMaxFromRules() {
        var inp = document.getElementById("limo-city-pax");
        var sel = document.getElementById("limo-city-location-id");
        if (!inp) {
            return;
        }
        var cap = LIMO_GLOBAL_MAX_PASSENGERS;
        var pid = sel && sel.value;
        if (pid) {
            var matching = cityRouteRules.filter(function (r) {
                return String(r.pickup) === String(pid);
            });
            if (matching.length) {
                cap = limoCapsFromRoutes(matching);
            }
        }
        inp.setAttribute("max", String(cap));
        var pv = parseInt(inp.value, 10);
        if (!isNaN(pv) && pv > cap) {
            inp.value = String(cap);
        }
    }

    /** City limo: match dashboard band (from–to pax) + city package hours for this pickup. */
    function limoCityPriceEstimate(rules, pickupId, paxRaw, hoursKey) {
        var pax = parseInt(paxRaw, 10);
        if (!pax || pax < 1 || !hoursKey) {
            return null;
        }
        if (!rules || !rules.length || !pickupId) {
            return null;
        }
        var pool = rules.filter(function (r) {
            return String(r.pickup) === String(pickupId);
        });
        if (!pool.length) {
            return null;
        }
        var amounts = [];
        pool.forEach(function (route) {
            var bands = route.bands || [];
            var cityPrices = route.city_prices || [];
            if (!bands.length && cityPrices.length) {
                var g0 = cityPrices[0].group;
                bands = [{ group: g0, from: 1, to: 50 }];
            }
            bands.forEach(function (band) {
                if (pax >= band.from && pax <= band.to) {
                    cityPrices.forEach(function (cp) {
                        if (Number(cp.group) === Number(band.group) && String(cp.hours) === String(hoursKey)) {
                            var ow = cp.ow;
                            if (typeof ow === "number" && !isNaN(ow) && ow > 0) {
                                amounts.push(ow);
                            }
                        }
                    });
                }
            });
        });
        if (!amounts.length) {
            return null;
        }
        return Math.min.apply(null, amounts);
    }

    function syncCityServiceFromRadio() {
        var panel = document.getElementById("panel-city");
        if (!panel) {
            return;
        }
        applyCityPaxMaxFromRules();
        var checked =
            panel.querySelector('input[name="city_service"]:checked') ||
            panel.querySelector('input[name="city-service"]:checked');
        if (!checked) {
            return;
        }
        var v = checked.value;
        var priceEl = document.getElementById("city-price");
        var labelEl = document.getElementById("city-hours-label");
        var citySel = document.getElementById("limo-city-location-id");
        var paxInp = document.getElementById("limo-city-pax");
        var pickupId = citySel && citySel.value;
        var paxVal = paxInp && paxInp.value;
        var est = limoCityPriceEstimate(cityRouteRules, pickupId, paxVal, v);
        if (est === null || est === undefined || isNaN(est)) {
            est = prices[v];
        }
        if (priceEl) {
            if (est !== null && est !== undefined && !isNaN(est)) {
                priceEl.textContent = String(Math.round(Number(est)));
            } else {
                priceEl.textContent = cityPriceMsgs.noTier || cityPriceMsgs.unavailable || "—";
            }
        }
        if (labelEl) {
            labelEl.textContent = labels[v] || "3 Hours";
        }
        var hidden = document.getElementById("limo-city-service-label");
        var summary = document.getElementById("city-service-summary");
        var card = checked.closest(".limo-service-card");
        var pkg = card && card.getAttribute("data-city-package");
        if (pkg && hidden) {
            hidden.value = pkg;
        }
        if (pkg && summary) {
            summary.textContent = pkg;
        }
    }
    document
        .querySelectorAll('#panel-city input[name="city_service"], #panel-city input[name="city-service"]')
        .forEach(function (r) {
            r.addEventListener("change", syncCityServiceFromRadio);
        });
    var limoCitySel = document.getElementById("limo-city-location-id");
    if (limoCitySel) {
        limoCitySel.addEventListener("change", syncCityServiceFromRadio);
    }
    var limoCityPax = document.getElementById("limo-city-pax");
    if (limoCityPax) {
        limoCityPax.addEventListener("input", syncCityServiceFromRadio);
        limoCityPax.addEventListener("change", syncCityServiceFromRadio);
    }
    syncCityServiceFromRadio();

    /** Destination location ids linked to a pickup in dashboard car routes. */
    function limoDestinationIdsForPickup(rules, serviceKey, pickupId) {
        if (!pickupId || !rules || !rules.length) {
            return [];
        }
        var svc = serviceKey === "airport" ? "airport" : "travel";
        var seen = {};
        var ids = [];
        rules.forEach(function (r) {
            if (!r[svc] || String(r.pickup) !== String(pickupId)) {
                return;
            }
            if (r.dest === null || r.dest === undefined) {
                return;
            }
            var d = String(r.dest);
            if (!seen[d]) {
                seen[d] = true;
                ids.push(Number(r.dest));
            }
        });
        ids.sort(function (a, b) {
            return a - b;
        });
        return ids;
    }

    function refillLinkedDestinationSelect(selectEl, pickupId, serviceKey) {
        if (!selectEl) {
            return;
        }
        var rules =
            typeof window.LIMO_TRIP_ROUTE_RULES === "object" && window.LIMO_TRIP_ROUTE_RULES !== null
                ? window.LIMO_TRIP_ROUTE_RULES
                : [];
        var labels =
            typeof window.LIMO_LOCATION_LABELS === "object" && window.LIMO_LOCATION_LABELS !== null
                ? window.LIMO_LOCATION_LABELS
                : {};
        var placeholder = selectEl.querySelector('option[value=""]');
        var placeholderText = placeholder ? placeholder.textContent : "Please select";
        var prev = selectEl.value;
        selectEl.innerHTML = "";
        var emptyOpt = document.createElement("option");
        emptyOpt.value = "";
        emptyOpt.textContent = placeholderText;
        selectEl.appendChild(emptyOpt);
        limoDestinationIdsForPickup(rules, serviceKey, pickupId).forEach(function (id) {
            var opt = document.createElement("option");
            opt.value = String(id);
            opt.textContent = labels[id] || labels[String(id)] || "Location " + id;
            selectEl.appendChild(opt);
        });
        if (prev && selectEl.querySelector('option[value="' + prev + '"]')) {
            selectEl.value = prev;
        } else {
            selectEl.value = "";
        }
    }

    /** Match dashboard car routes (pickup + destination) for airport or travel service. */
    function limoMatchingRoutePool(rules, serviceKey, pickupId, destId) {
        var pickup = pickupId ? String(pickupId) : "";
        var dest = destId ? String(destId) : "";
        if (!pickup || !rules || !rules.length) {
            return [];
        }
        var svc = serviceKey === "airport" ? "airport" : "travel";
        var candidates = rules.filter(function (r) {
            return r[svc] && String(r.pickup) === pickup;
        });
        if (!candidates.length) {
            return [];
        }
        var pool;
        if (!dest) {
            pool = candidates.filter(function (r) {
                return r.dest === null || r.dest === undefined;
            });
        } else {
            var exact = candidates.filter(function (r) {
                return r.dest !== null && r.dest !== undefined && String(r.dest) === dest;
            });
            pool = exact.length
                ? exact
                : candidates.filter(function (r) {
                      return r.dest === null || r.dest === undefined;
                  });
        }
        return pool || [];
    }

    /** One Way / Round Trip visibility flags from matched routes. */
    function mergeLimoTripFlags(routes, serviceKey, pickupId, destId) {
        var pool = limoMatchingRoutePool(routes, serviceKey, pickupId, destId);
        if (!pool.length) {
            return { ow: true, rt: true };
        }
        var ow = pool.some(function (r) {
            return r.ow;
        });
        var rt = pool.some(function (r) {
            return r.rt;
        });
        if (!ow && !rt) {
            return { ow: true, rt: true };
        }
        return { ow: ow, rt: rt };
    }

    function limoTripRadioIsRound(groupName) {
        var c = document.querySelector('input[name="' + groupName + '"]:checked');
        return !!(c && c.value === "round");
    }

    function limoFormatEgp(amount) {
        if (amount === null || amount === undefined || isNaN(amount)) {
            return "—";
        }
        return "$" + String(Math.round(Number(amount)));
    }

    function limoEstimatePrice(rules, serviceKey, pickupId, destId, paxRaw, isRoundTrip) {
        var pax = parseInt(paxRaw, 10);
        if (!pax || pax < 1) {
            return null;
        }
        var pool = limoMatchingRoutePool(rules, serviceKey, pickupId, destId);
        if (!pool.length) {
            return null;
        }
        var amounts = [];
        pool.forEach(function (route) {
            var tiers = route.prices || [];
            tiers.forEach(function (t) {
                if (pax >= t.from && pax <= t.to) {
                    var amt = isRoundTrip ? t.rt : t.ow;
                    if (typeof amt === "number" && !isNaN(amt) && amt > 0) {
                        amounts.push(amt);
                    }
                }
            });
        });
        if (!amounts.length) {
            return null;
        }
        return Math.min.apply(null, amounts);
    }

    function bindLimoPaxPriceEstimate(serviceKey, pickupSel, destSel, paxInput, priceEl, groupName) {
        var rules =
            typeof window.LIMO_TRIP_ROUTE_RULES === "object" && window.LIMO_TRIP_ROUTE_RULES !== null
                ? window.LIMO_TRIP_ROUTE_RULES
                : [];
        var msgs =
            typeof window.LIMO_PRICE_MESSAGES === "object" && window.LIMO_PRICE_MESSAGES !== null
                ? window.LIMO_PRICE_MESSAGES
                : { unavailable: "—", noTier: "—" };
        function update() {
            if (!priceEl) {
                return;
            }
            var isRound = limoTripRadioIsRound(groupName);
            var pool = limoMatchingRoutePool(
                rules,
                serviceKey,
                pickupSel && pickupSel.value,
                destSel && destSel.value
            );
            var cap = pool.length ? limoCapsFromRoutes(pool) : LIMO_GLOBAL_MAX_PASSENGERS;
            if (paxInput) {
                paxInput.setAttribute("max", String(cap));
                var paxCur = parseInt(paxInput.value, 10);
                if (!isNaN(paxCur) && paxCur > cap) {
                    paxInput.value = String(cap);
                }
            }
            if (!pool.length) {
                priceEl.textContent = msgs.unavailable || "—";
                return;
            }
            var amt = limoEstimatePrice(
                rules,
                serviceKey,
                pickupSel && pickupSel.value,
                destSel && destSel.value,
                paxInput && paxInput.value,
                isRound
            );
            if (amt === null) {
                priceEl.textContent = msgs.noTier || msgs.unavailable || "—";
                return;
            }
            priceEl.textContent = limoFormatEgp(amt);
        }
        function onAnyChange() {
            update();
        }
        if (pickupSel) {
            pickupSel.addEventListener("change", onAnyChange);
        }
        if (destSel) {
            destSel.addEventListener("change", onAnyChange);
        }
        if (paxInput) {
            paxInput.addEventListener("input", onAnyChange);
            paxInput.addEventListener("change", onAnyChange);
        }
        document.querySelectorAll('input[name="' + groupName + '"]').forEach(function (r) {
            r.addEventListener("change", onAnyChange);
        });
        document.addEventListener("limo-trip-mode-sync", function (e) {
            if (e.detail && e.detail.group === groupName) {
                update();
            }
        });
        update();
    }

    function applyLimoTripModeLabels(groupName, pickupSelect, destSelect, serviceKey) {
        var rules =
            typeof window.LIMO_TRIP_ROUTE_RULES === "object" && window.LIMO_TRIP_ROUTE_RULES !== null
                ? window.LIMO_TRIP_ROUTE_RULES
                : [];
        function sync() {
            var flags = mergeLimoTripFlags(
                rules,
                serviceKey,
                pickupSelect && pickupSelect.value,
                destSelect && destSelect.value
            );
            document
                .querySelectorAll('.limo-trip-mode-label[data-limo-trip-group="' + groupName + '"]')
                .forEach(function (lbl) {
                    var v = lbl.getAttribute("data-limo-trip-value");
                    var show = (v === "round" && flags.rt) || (v === "one" && flags.ow);
                    lbl.classList.toggle("hidden", !show);
                });
            var radios = [];
            document.querySelectorAll('input[name="' + groupName + '"]').forEach(function (inp) {
                var lab = inp.closest(".limo-trip-mode-label");
                if (lab && !lab.classList.contains("hidden")) {
                    radios.push(inp);
                }
            });
            var checked = document.querySelector('input[name="' + groupName + '"]:checked');
            if (
                checked &&
                checked.closest(".limo-trip-mode-label") &&
                checked.closest(".limo-trip-mode-label").classList.contains("hidden")
            ) {
                checked.checked = false;
            }
            if (radios.length === 1) {
                radios[0].checked = true;
            } else if (radios.length === 0) {
                document
                    .querySelectorAll('.limo-trip-mode-label[data-limo-trip-group="' + groupName + '"]')
                    .forEach(function (lbl) {
                        lbl.classList.remove("hidden");
                    });
                var fallback = document.querySelector('input[name="' + groupName + '"][value="one"]');
                if (fallback) {
                    fallback.checked = true;
                }
            } else if (!document.querySelector('input[name="' + groupName + '"]:checked')) {
                var preferOne = null;
                for (var ri = 0; ri < radios.length; ri++) {
                    if (radios[ri].value === "one") {
                        preferOne = radios[ri];
                        break;
                    }
                }
                (preferOne || radios[0]).checked = true;
            }
            updateReturnDateVisibility(groupName);
            document.dispatchEvent(new CustomEvent("limo-trip-mode-sync", { detail: { group: groupName } }));
        }
        if (pickupSelect) {
            pickupSelect.addEventListener("change", function () {
                if (destSelect) {
                    refillLinkedDestinationSelect(destSelect, pickupSelect.value, serviceKey);
                }
                sync();
            });
            if (destSelect) {
                refillLinkedDestinationSelect(destSelect, pickupSelect.value, serviceKey);
            }
        }
        if (destSelect) {
            destSelect.addEventListener("change", sync);
        }
        sync();
    }

    applyLimoTripModeLabels(
        "airport-trip",
        document.querySelector("#airport-pickup-location-id"),
        document.querySelector("#airport-destination-location-id"),
        "airport"
    );
    applyLimoTripModeLabels(
        "travel-trip",
        document.querySelector("#travel-from-location-id"),
        document.querySelector("#travel-to-location-id"),
        "travel"
    );

    bindLimoPaxPriceEstimate(
        "airport",
        document.querySelector("#airport-pickup-location-id"),
        document.querySelector("#airport-destination-location-id"),
        document.querySelector("#airport-pax"),
        document.getElementById("airport-estimated-price"),
        "airport-trip"
    );
    bindLimoPaxPriceEstimate(
        "travel",
        document.querySelector("#travel-from-location-id"),
        document.querySelector("#travel-to-location-id"),
        document.querySelector("#travel-pax"),
        document.getElementById("travel-estimated-price"),
        "travel-trip"
    );

    // toggle return date field when round trip selected
    function updateReturnDateVisibility(name) {
        var checked = document.querySelector('input[name="' + name + '"]:checked');
        if (!checked) return;
        var targetId = checked.getAttribute("data-target");
        if (!targetId) return;
        var target = document.getElementById(targetId);
        if (!target) return;
        target.classList.toggle("hidden", checked.value !== "round");
    }

    ["airport-trip", "travel-trip"].forEach(function (groupName) {
        var radios = document.querySelectorAll('input[name="' + groupName + '"]');
        radios.forEach(function (radio) {
            radio.addEventListener("change", function () {
                updateReturnDateVisibility(groupName);
            });
        });
        updateReturnDateVisibility(groupName);
    });

    // open native date picker on click/focus when supported
    document.querySelectorAll('input[type="date"].limo-date-picker').forEach(function (input) {
        var openPicker = function () {
            if (typeof input.showPicker === "function") {
                input.showPicker();
            }
        };
        input.addEventListener("click", openPicker);
        input.addEventListener("focus", openPicker);
    });

    var openVideoBtn = document.getElementById("open-video-overlay");
    var closeVideoBtn = document.getElementById("close-video-overlay");
    var videoOverlay = document.getElementById("video-overlay");
    var videoFrame = document.getElementById("video-overlay-frame");
    var currentVideoUrl = "";

    function closeVideoOverlay() {
        if (!videoOverlay) return;
        videoOverlay.classList.add("hidden");
        videoOverlay.classList.remove("flex");
        videoOverlay.setAttribute("aria-hidden", "true");
        document.body.classList.remove("overflow-hidden");
        if (videoFrame) videoFrame.src = "";
        currentVideoUrl = "";
    }

    if (openVideoBtn && videoOverlay && videoFrame) {
        openVideoBtn.addEventListener("click", function () {
            currentVideoUrl = openVideoBtn.getAttribute("data-video-url") || "";
            if (!currentVideoUrl) return;
            videoFrame.src = currentVideoUrl;
            videoOverlay.classList.remove("hidden");
            videoOverlay.classList.add("flex");
            videoOverlay.setAttribute("aria-hidden", "false");
            document.body.classList.add("overflow-hidden");
        });
    }

    if (closeVideoBtn) {
        closeVideoBtn.addEventListener("click", closeVideoOverlay);
    }

    if (videoOverlay) {
        videoOverlay.addEventListener("click", function (event) {
            if (event.target === videoOverlay) {
                closeVideoOverlay();
            }
        });
    }

    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape" && videoOverlay && !videoOverlay.classList.contains("hidden")) {
            closeVideoOverlay();
        }
    });

    document.querySelectorAll("form.limo-search-form").forEach(function (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            var errEl = form.querySelector(".limo-search-form-error");
            if (errEl) {
                errEl.textContent = "";
                errEl.classList.add("hidden");
            }
            var btn = form.querySelector("button.limo-search-submit");
            var originalText = btn ? btn.textContent : "";
            var loadingText = btn && btn.getAttribute("data-loading-text") ? btn.getAttribute("data-loading-text") : "…";
            if (btn) {
                btn.disabled = true;
                btn.textContent = loadingText;
            }
            var u = new URL(form.action || window.location.href, window.location.href);
            u.search = new URLSearchParams(new FormData(form)).toString();
            fetch(u.toString(), {
                method: "GET",
                headers: {
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                },
                credentials: "same-origin",
            })
                .then(function (res) {
                    return res
                        .json()
                        .then(function (data) {
                            return { ok: res.ok, data: data };
                        })
                        .catch(function () {
                            return { ok: false, data: null };
                        });
                })
                .then(function (result) {
                    if (btn) {
                        btn.disabled = false;
                        btn.textContent = originalText;
                    }
                    if (result.ok && result.data && result.data.redirect) {
                        window.location.href = result.data.redirect;
                        return;
                    }
                    var msg =
                        (result.data && (result.data.message || result.data.error)) ||
                        "Something went wrong. Please try again.";
                    if (errEl) {
                        errEl.textContent = msg;
                        errEl.classList.remove("hidden");
                        errEl.scrollIntoView({ block: "nearest", behavior: "smooth" });
                    } else if (typeof window.toastr !== "undefined" && typeof window.toastr.error === "function") {
                        window.toastr.error(msg);
                    } else {
                        window.alert(msg);
                    }
                })
                .catch(function () {
                    if (btn) {
                        btn.disabled = false;
                        btn.textContent = originalText;
                    }
                    var msg = "Network error. Please try again.";
                    if (errEl) {
                        errEl.textContent = msg;
                        errEl.classList.remove("hidden");
                    } else {
                        window.alert(msg);
                    }
                });
        });
    });

    var limoSearchMsgs =
        typeof window.LIMO_SEARCH_MESSAGES === "object" && window.LIMO_SEARCH_MESSAGES !== null
            ? window.LIMO_SEARCH_MESSAGES
            : {};

    function limoToastError(msg) {
        if (typeof window.toastr !== "undefined" && typeof window.toastr.error === "function") {
            window.toastr.error(msg);
        } else {
            window.alert(msg);
        }
    }

    function limoCompletingBookingUrl() {
        return typeof window.LIMO_COMPLETING_BOOKING_URL === "string" && window.LIMO_COMPLETING_BOOKING_URL
            ? window.LIMO_COMPLETING_BOOKING_URL
            : "/limo/complete-booking";
    }

    function limoPanelDateValues(panel) {
        if (!panel) {
            return { pickup: "", ret: "" };
        }
        var dates = panel.querySelectorAll('input.limo-date-picker[type="date"]');
        var pickup = dates[0] && dates[0].value ? dates[0].value : "";
        var ret = dates[1] && dates[1].value ? dates[1].value : "";
        return { pickup: pickup, ret: ret };
    }

    function limoRedirectWithPrefill(opts) {
        var base = limoCompletingBookingUrl();
        if (!base) {
            return;
        }
        var params = new URLSearchParams();
        params.set("type", opts.type);
        if (opts.pickupId) {
            params.set("pickup_id", String(opts.pickupId));
        }
        if (opts.destId) {
            params.set("dest_id", String(opts.destId));
        }
        if (opts.pax) {
            params.set("pax", String(opts.pax));
        }
        if (opts.type !== "city") {
            params.set("trip", opts.tripRound ? "round" : "one");
        }
        if (opts.pickupDate) {
            params.set("pickup_date", opts.pickupDate);
        }
        if (opts.returnDate) {
            params.set("return_date", opts.returnDate);
        }
        if (opts.price != null && !isNaN(opts.price)) {
            params.set("price", String(Math.round(opts.price)));
        }
        if (opts.cityHours) {
            params.set("city_hours", String(opts.cityHours));
        }
        var sep = base.indexOf("?") >= 0 ? "&" : "?";
        window.location.href = base + sep + params.toString();
    }

    var limoRulesForSearch =
        typeof window.LIMO_TRIP_ROUTE_RULES === "object" && window.LIMO_TRIP_ROUTE_RULES !== null
            ? window.LIMO_TRIP_ROUTE_RULES
            : [];

    var btnAirportSearch = document.getElementById("limo-btn-search-airport");
    if (btnAirportSearch) {
        btnAirportSearch.addEventListener("click", function () {
            var pickupSel = document.querySelector("#airport-pickup-location-id");
            var destSel = document.querySelector("#airport-destination-location-id");
            var paxInp = document.querySelector("#airport-pax");
            if (!pickupSel || !pickupSel.value) {
                limoToastError(limoSearchMsgs.missing_fields || "Please complete required fields.");
                return;
            }
            var destVal = destSel && destSel.value ? destSel.value : "";
            var pax = parseInt(paxInp && paxInp.value, 10);
            if (!pax || pax < 1) {
                limoToastError(limoSearchMsgs.invalid_pax || limoSearchMsgs.missing_fields || "Invalid passengers.");
                return;
            }
            var apMax = paxInp ? parseInt(paxInp.getAttribute("max"), 10) : NaN;
            if (!isNaN(apMax) && apMax > 0 && pax > apMax) {
                limoToastError(limoSearchMsgs.invalid_pax || "Too many passengers for this route.");
                return;
            }
            var pool = limoMatchingRoutePool(limoRulesForSearch, "airport", pickupSel.value, destVal);
            if (!pool.length) {
                limoToastError(limoSearchMsgs.route_not_found || "Route not available.");
                return;
            }
            var isRound = limoTripRadioIsRound("airport-trip");
            var price = limoEstimatePrice(
                limoRulesForSearch,
                "airport",
                pickupSel.value,
                destVal,
                String(pax),
                isRound
            );
            if (price === null) {
                limoToastError(limoSearchMsgs.no_price_tier || "No price for this group size.");
                return;
            }
            var datesA = limoPanelDateValues(document.getElementById("panel-airport"));
            limoRedirectWithPrefill({
                type: "airport",
                pickupId: pickupSel.value,
                destId: destVal,
                pax: pax,
                tripRound: isRound,
                pickupDate: datesA.pickup,
                returnDate: datesA.ret,
                price: price
            });
        });
    }

    var btnTravelSearch = document.getElementById("limo-btn-search-travel");
    if (btnTravelSearch) {
        btnTravelSearch.addEventListener("click", function () {
            var fromSel = document.querySelector("#travel-from-location-id");
            var toSel = document.querySelector("#travel-to-location-id");
            var paxInp = document.querySelector("#travel-pax");
            if (!fromSel || !fromSel.value) {
                limoToastError(limoSearchMsgs.missing_fields || "Please complete required fields.");
                return;
            }
            var toVal = toSel && toSel.value ? toSel.value : "";
            var pax = parseInt(paxInp && paxInp.value, 10);
            if (!pax || pax < 1) {
                limoToastError(limoSearchMsgs.invalid_pax || limoSearchMsgs.missing_fields || "Invalid passengers.");
                return;
            }
            var trMax = paxInp ? parseInt(paxInp.getAttribute("max"), 10) : NaN;
            if (!isNaN(trMax) && trMax > 0 && pax > trMax) {
                limoToastError(limoSearchMsgs.invalid_pax || "Too many passengers for this route.");
                return;
            }
            var pool = limoMatchingRoutePool(limoRulesForSearch, "travel", fromSel.value, toVal);
            if (!pool.length) {
                limoToastError(limoSearchMsgs.route_not_found || "Route not available.");
                return;
            }
            var isRound = limoTripRadioIsRound("travel-trip");
            var price = limoEstimatePrice(
                limoRulesForSearch,
                "travel",
                fromSel.value,
                toVal,
                String(pax),
                isRound
            );
            if (price === null) {
                limoToastError(limoSearchMsgs.no_price_tier || "No price for this group size.");
                return;
            }
            var datesT = limoPanelDateValues(document.getElementById("panel-travel"));
            limoRedirectWithPrefill({
                type: "travel",
                pickupId: fromSel.value,
                destId: toVal,
                pax: pax,
                tripRound: isRound,
                pickupDate: datesT.pickup,
                returnDate: datesT.ret,
                price: price
            });
        });
    }

    var btnCitySearch = document.getElementById("limo-btn-search-city");
    if (btnCitySearch) {
        btnCitySearch.addEventListener("click", function () {
            var citySel = document.getElementById("limo-city-location-id");
            var cityPaxInp = document.getElementById("limo-city-pax");
            if (!citySel || !citySel.value) {
                limoToastError(limoSearchMsgs.missing_fields || "Please complete required fields.");
                return;
            }
            var pax = parseInt(cityPaxInp && cityPaxInp.value, 10);
            if (!pax || pax < 1) {
                limoToastError(limoSearchMsgs.invalid_pax || limoSearchMsgs.missing_fields || "Invalid passengers.");
                return;
            }
            var cityMaxAttr = cityPaxInp ? parseInt(cityPaxInp.getAttribute("max"), 10) : NaN;
            var cityCap =
                !isNaN(cityMaxAttr) && cityMaxAttr > 0 ? cityMaxAttr : LIMO_GLOBAL_MAX_PASSENGERS;
            if (pax > cityCap) {
                limoToastError(limoSearchMsgs.invalid_pax || "Too many passengers for the selected city.");
                return;
            }
            var panel = document.getElementById("panel-city");
            var datesC = limoPanelDateValues(panel);
            var checked =
                (panel && panel.querySelector('input[name="city-service"]:checked')) ||
                (panel && panel.querySelector('input[name="city_service"]:checked'));
            var hoursKey = checked && checked.value ? checked.value : "3";
            var cityRules =
                typeof window.LIMO_CITY_ROUTE_RULES === "object" && window.LIMO_CITY_ROUTE_RULES !== null
                    ? window.LIMO_CITY_ROUTE_RULES
                    : [];
            var cityPrice = limoCityPriceEstimate(cityRules, citySel.value, String(pax), hoursKey);
            if (cityPrice === null || cityPrice === undefined || isNaN(cityPrice)) {
                cityPrice = prices[hoursKey];
            }
            if (cityPrice == null || isNaN(cityPrice)) {
                limoToastError(limoSearchMsgs.no_price_tier || "No price for this package.");
                return;
            }
            limoRedirectWithPrefill({
                type: "city",
                pickupId: citySel.value,
                destId: "",
                pax: pax,
                tripRound: false,
                pickupDate: datesC.pickup,
                returnDate: "",
                price: cityPrice,
                cityHours: hoursKey
            });
        });
    }

    window.addEventListener("load", function () {
        if (typeof AOS !== "undefined") {
            AOS.refresh();
        }
    });
})();
