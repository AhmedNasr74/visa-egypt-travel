(function () {
    "use strict";

    var pages = [];
    var currentScreen = 1;
    var passengerPhase = "form";
    var flightInputPage1 = null;
    var flightInputPage2 = null;

    var userInfo = {
        name: "",
        email: "",
        phone: "",
        nationality: ""
    };

    var booking = {
        flightNumber: "",
        airline: "",
        pickupTime: "09:00",
        terminal: "T1",
        pickupDate: "",
        address: "",
        routePickup: "",
        routeDrop: "",
        paxCount: 1,
        tripRound: false,
        vehiclePriceEgp: null,
        serviceType: "airport",
        cityHours: "",
        cityHoursLabel: "",
        returnDate: ""
    };

    function $(sel, root) {
        return (root || document).querySelector(sel);
    }

    function $all(sel, root) {
        return Array.prototype.slice.call((root || document).querySelectorAll(sel));
    }

    function pad2(n) {
        return String(n).length < 2 ? "0" + n : String(n);
    }

    function formatDisplayDate(iso) {
        if (!iso) return "";
        var p = iso.split("-");
        if (p.length !== 3) return iso;
        return pad2(p[2]) + "-" + pad2(p[1]) + "-" + p[0];
    }

    function formatLongDate(iso) {
        if (!iso) return "";
        var d = new Date(iso + "T12:00:00");
        if (isNaN(d.getTime())) return iso;
        return d.toLocaleDateString("en-US", {
            weekday: "long",
            month: "short",
            day: "numeric",
            year: "numeric"
        });
    }

    function formatTimeLabel(hm) {
        if (!hm) return "";
        var parts = hm.split(":");
        var h = parseInt(parts[0], 10);
        var m = parseInt(parts[1] || "0", 10);
        if (isNaN(h)) return hm;
        var suffix = h < 12 ? "AM" : "PM";
        var h12 = h % 12;
        if (h12 === 0) h12 = 12;
        return h12 + ":" + pad2(m) + " " + suffix;
    }

    function todayIso() {
        var d = new Date();
        return d.getFullYear() + "-" + pad2(d.getMonth() + 1) + "-" + pad2(d.getDate());
    }

    function splitVatFromInclusive(total) {
        var t = Math.round(Number(total));
        if (!isFinite(t) || t <= 0) {
            return { base: 0, vat: 0, total: 0 };
        }
        var vat = Math.round((t * 14) / 114);
        return { base: t - vat, vat: vat, total: t };
    }

    function applyLimoPrefillFromServer() {
        var p = window.LIMO_COMPLETING_PREFILL;
        if (!p || typeof p !== "object") {
            return;
        }
        booking.serviceType = p.type === "travel" || p.type === "city" ? p.type : "airport";
        booking.routePickup = typeof p.pickup_name === "string" ? p.pickup_name : "";
        booking.routeDrop = typeof p.dest_name === "string" ? p.dest_name : "";
        var px = parseInt(p.pax, 10);
        var cap = parseInt(p.max_pax, 10);
        if (!isNaN(px) && px > 0) {
            booking.paxCount = !isNaN(cap) && cap > 0 ? Math.min(px, cap) : px;
        } else {
            booking.paxCount = 1;
        }
        booking.tripRound = p.trip === "round";
        if (p.pickup_date) {
            booking.pickupDate = String(p.pickup_date);
        }
        if (p.return_date) {
            booking.returnDate = String(p.return_date);
        }
        booking.cityHours = typeof p.city_hours === "string" ? p.city_hours : "";
        booking.cityHoursLabel = typeof p.city_hours_label === "string" ? p.city_hours_label : "";
        if (p.estimated_price != null && p.estimated_price !== "") {
            var pr = Number(p.estimated_price);
            if (!isNaN(pr) && pr > 0) {
                booking.vehiclePriceEgp = Math.round(pr);
            }
        }
        if (!booking.pickupDate) {
            booking.pickupDate = todayIso();
        }
        if (booking.routeDrop && !booking.address) {
            booking.address = booking.routeDrop;
        }
    }

    function summaryPickupLine() {
        if (booking.serviceType === "city") {
            return booking.routePickup || "—";
        }
        var base = booking.routePickup || "—";
        if (booking.serviceType === "airport") {
            return base + (booking.terminal ? " - " + booking.terminal : "");
        }
        return base;
    }

    function summaryDropHeading() {
        if (booking.serviceType === "city") {
            return "Service";
        }
        if (booking.serviceType === "travel") {
            return "Destination";
        }
        return "Drop-off";
    }

    function summaryDropTitle() {
        if (booking.serviceType === "city") {
            return booking.cityHoursLabel || "City ride";
        }
        return booking.routeDrop || "—";
    }

    function summaryDropSub() {
        if (booking.serviceType === "city" && booking.routePickup) {
            return "In " + booking.routePickup;
        }
        return "";
    }

    function formatEgp(n) {
        if (!isFinite(n) || n <= 0) {
            return "—";
        }
        return String(Math.round(n)) + " EGP";
    }

    function syncBookingToDom() {
        $all("[data-bind='flight-number']").forEach(function (el) {
            el.textContent = booking.flightNumber || "—";
        });
        $all("[data-bind='airline']").forEach(function (el) {
            el.textContent = booking.airline || "—";
        });
        $all("[data-bind='terminal']").forEach(function (el) {
            el.textContent = booking.terminal || "—";
        });
        $all("[data-bind='pickup-datetime']").forEach(function (el) {
            el.textContent =
                formatLongDate(booking.pickupDate) +
                ", " +
                formatTimeLabel(booking.pickupTime);
        });
        $all("[data-bind='address']").forEach(function (el) {
            el.textContent = booking.address || "";
        });
        var addrInput = $("#cb-address-input");
        if (addrInput) addrInput.value = booking.address || "";

        $all("[data-bind='route-pickup']").forEach(function (el) {
            el.textContent = booking.routePickup || "—";
        });
        $all("[data-bind='route-drop']").forEach(function (el) {
            if (booking.serviceType === "city") {
                el.textContent = booking.cityHoursLabel || booking.routePickup || "—";
            } else {
                el.textContent = booking.routeDrop || "—";
            }
        });

        var tripLbl = booking.tripRound ? "Round trip price" : "One way trip price";
        $all("[data-bind='trip-price-label']").forEach(function (el) {
            el.textContent = tripLbl;
        });

        var priceText = booking.vehiclePriceEgp != null ? formatEgp(booking.vehiclePriceEgp) : "—";
        $all("[data-bind='vehicle-price']").forEach(function (el) {
            el.textContent = priceText;
        });

        var paxLabel = booking.paxCount === 1 ? "1 seat" : booking.paxCount + " seats";
        $all("[data-bind='pax-seats']").forEach(function (el) {
            el.textContent = paxLabel;
        });

        var sub = $("#cb-header-subtitle");
        if (sub) {
            var typeLine = {
                airport: "Airport limousine",
                travel: "Travel limousine",
                city: "City ride"
            };
            var t1 = typeLine[booking.serviceType] || "Limo";
            var t2 = booking.tripRound ? "Round trip" : "One way";
            sub.textContent = t2 + " · " + t1;
        }

        $all("[data-bind='summary-pickup-line']").forEach(function (el) {
            el.textContent = summaryPickupLine();
        });
        $all("[data-bind='summary-drop-heading']").forEach(function (el) {
            el.textContent = summaryDropHeading();
        });
        $all("[data-bind='summary-drop-title']").forEach(function (el) {
            el.textContent = summaryDropTitle();
        });
        $all("[data-bind='summary-drop-sub']").forEach(function (el) {
            var sub = summaryDropSub();
            el.textContent = sub;
            if (el.tagName === "P") {
                el.classList.toggle("hidden", !sub);
            }
        });

        var split = splitVatFromInclusive(booking.vehiclePriceEgp || 0);
        $all("[data-bind='price-before-vat']").forEach(function (el) {
            el.textContent = split.total > 0 ? formatEgp(split.base) : "—";
        });
        $all("[data-bind='price-vat']").forEach(function (el) {
            el.textContent = split.total > 0 ? formatEgp(split.vat) : "—";
        });
        $all("[data-bind='price-total']").forEach(function (el) {
            el.textContent = split.total > 0 ? formatEgp(split.total) : "—";
        });

        var pn = $("#cb-summary-flight-num");
        if (pn) pn.textContent = booking.flightNumber || "—";
        var pa = $("#cb-summary-airline");
        if (pa) pa.textContent = booking.airline || "—";

        var uiName = $("#cb-display-name");
        var uiEmail = $("#cb-display-email");
        var uiPhone = $("#cb-display-phone");
        var uiNat = $("#cb-display-nationality");
        if (uiName) uiName.textContent = userInfo.name || "—";
        if (uiEmail) uiEmail.textContent = userInfo.email || "—";
        if (uiPhone) uiPhone.textContent = userInfo.phone || "—";
        if (uiNat) uiNat.textContent = userInfo.nationality || "—";

        $all("[data-copy-name]").forEach(function (el) {
            el.textContent = userInfo.name || "—";
        });
        $all("[data-copy-email]").forEach(function (el) {
            el.textContent = userInfo.email || "—";
        });
        $all("[data-copy-phone]").forEach(function (el) {
            el.textContent = userInfo.phone || "—";
        });
        $all("[data-copy-nationality]").forEach(function (el) {
            el.textContent = userInfo.nationality || "—";
        });
    }

    function readBookingFromForm() {
        var fn1 = flightInputPage1 && flightInputPage1.value.trim();
        var fn2 = flightInputPage2 && flightInputPage2.value.trim();
        if (fn1) booking.flightNumber = fn1;
        if (fn2) booking.flightNumber = fn2;

        var airlineEl = $("#cb-airline");
        if (airlineEl) booking.airline = airlineEl.value.trim();

        var timeEl = $("#cb-pickup-time");
        if (timeEl) booking.pickupTime = timeEl.value;

        var termEl = $("#cb-terminal");
        if (termEl) booking.terminal = termEl.value;

        var dateEl = $("#cb-pickup-date");
        if (dateEl && dateEl.value) booking.pickupDate = dateEl.value;

        var addrEl = $("#cb-address-input");
        if (addrEl) booking.address = addrEl.value.trim() || booking.address;
    }

    function csrfToken() {
        var m = document.querySelector('meta[name="csrf-token"]');
        return m ? m.getAttribute("content") : "";
    }

    function limoToast(kind, msg) {
        if (typeof window.toastr !== "undefined") {
            if (kind === "success" && typeof window.toastr.success === "function") {
                window.toastr.success(msg);
                return;
            }
            if (kind === "error" && typeof window.toastr.error === "function") {
                window.toastr.error(msg);
                return;
            }
        }
        window.alert(msg);
    }

    function limoBookingNotes(guestNotes) {
        var lines = [];
        var p = window.LIMO_COMPLETING_PREFILL || {};
        lines.push("Limo service type: " + (booking.serviceType || p.type || ""));
        if (p.pickup_name) {
            lines.push("Search pickup: " + p.pickup_name);
        }
        if (p.dest_name) {
            lines.push("Search destination: " + p.dest_name);
        }
        if (p.city_hours_label) {
            lines.push("City package: " + p.city_hours_label);
        }
        if (booking.flightNumber) {
            lines.push("Flight number: " + booking.flightNumber);
        }
        if (booking.airline) {
            lines.push("Airline: " + booking.airline);
        }
        if (booking.terminal) {
            lines.push("Terminal: " + booking.terminal);
        }
        if (booking.address) {
            lines.push("Drop-off address: " + booking.address);
        }
        if (guestNotes) {
            lines.push("Guest notes: " + guestNotes);
        }
        if (userInfo.nationality && userInfo.nationality.trim()) {
            lines.push("Nationality: " + userInfo.nationality.trim());
        }
        return lines.join("\n");
    }

    function buildLimoBookingPayload() {
        readBookingFromForm();
        var p = window.LIMO_COMPLETING_PREFILL || {};
        var pickupId = parseInt(p.pickup_id, 10);
        if (!pickupId || pickupId < 1) {
            return { error: "Missing pickup location. Please start again from the limo search page." };
        }
        var destRaw = p.dest_id;
        var destId =
            destRaw !== null && destRaw !== undefined && destRaw !== ""
                ? parseInt(destRaw, 10)
                : 0;
        if (!destId || destId < 1) {
            destId = pickupId;
        }
        var price = booking.vehiclePriceEgp;
        if (price === null || price === undefined || isNaN(price) || price <= 0) {
            return { error: "Price is missing. Please start again from the limo search page." };
        }
        var timeEl = $("#cb-pickup-time");
        var pickupTimeVal = timeEl && timeEl.value ? timeEl.value : booking.pickupTime;
        if (!pickupTimeVal) {
            return { error: "Please choose a pickup time." };
        }
        if (!booking.pickupDate) {
            return { error: "Please choose a pickup date." };
        }
        var vehicleTitleEl = $("#cb-vehicle-title");
        var carType =
            vehicleTitleEl && vehicleTitleEl.textContent
                ? vehicleTitleEl.textContent.replace(/\s+/g, " ").trim()
                : null;
        var notesEl = $("#cb-booking-notes");
        var guestNotes = notesEl ? notesEl.value.trim() : "";
        return {
            pickup_location_id: pickupId,
            destination_id: destId,
            adults: booking.paxCount,
            children: 0,
            car_route_price: Math.round(Number(price) * 100) / 100,
            car_type: carType || null,
            oneway: !booking.tripRound,
            pickup_date: booking.pickupDate,
            pickup_time: pickupTimeVal,
            return_date: booking.tripRound && booking.returnDate ? booking.returnDate : null,
            name: userInfo.name,
            email: userInfo.email,
            phone: userInfo.phone,
            nationality: userInfo.nationality && userInfo.nationality.trim() ? userInfo.nationality.trim() : null,
            notes: limoBookingNotes(guestNotes) || null,
        };
    }

    function submitLimoBooking(btn) {
        var url =
            typeof window.LIMO_BOOKING_STORE_URL === "string" && window.LIMO_BOOKING_STORE_URL
                ? window.LIMO_BOOKING_STORE_URL
                : null;
        if (!url) {
            limoToast("error", "Booking could not be sent. Please try again later.");
            return;
        }
        var payload = buildLimoBookingPayload();
        if (payload.error) {
            limoToast("error", payload.error);
            return;
        }
        var token = csrfToken();
        if (!token) {
            limoToast("error", "Security token missing. Refresh the page and try again.");
            return;
        }
        if (btn) {
            btn.disabled = true;
        }
        fetch(url, {
            method: "POST",
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token,
            },
            credentials: "same-origin",
            body: JSON.stringify(payload),
        })
            .then(function (res) {
                return res.json().then(function (data) {
                    return { ok: res.ok, status: res.status, data: data };
                });
            })
            .then(function (result) {
                if (result.ok && result.data && result.data.ok) {
                    var msg =
                        (result.data && result.data.message) ||
                        (typeof window.LIMO_BOOKING_SUCCESS_MSG === "string"
                            ? window.LIMO_BOOKING_SUCCESS_MSG
                            : "Thank you! Your booking request has been recorded.");
                    limoToast("success", msg);
                    return;
                }
                var d = result.data || {};
                if (d.errors && typeof d.errors === "object") {
                    Object.keys(d.errors).forEach(function (k) {
                        var arr = d.errors[k];
                        if (Array.isArray(arr)) {
                            arr.forEach(function (m) {
                                limoToast("error", m);
                            });
                        }
                    });
                    return;
                }
                limoToast("error", d.message || "Could not save your booking. Please try again.");
            })
            .catch(function () {
                limoToast("error", "Network error. Please try again.");
            })
            .finally(function () {
                if (btn) {
                    btn.disabled = false;
                }
            });
    }

    function isValidFlightNumber(v) {
        if (!v || v.length < 2) return false;
        return /^[A-Za-z0-9]{2,10}$/.test(v.replace(/\s+/g, ""));
    }

    function isValidEmail(v) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
    }

    function showScreen(n) {
        currentScreen = n;
        pages.forEach(function (section) {
            var num = parseInt(section.getAttribute("data-cb-page"), 10);
            var show = num === n;
            if (show) {
                section.classList.remove("hidden");
                section.hidden = false;
            } else {
                section.classList.add("hidden");
                section.hidden = true;
            }
        });

        var p5Intro = $("#cb-page5-intro");
        var p5Main = $("#cb-page5-main");
        if (n === 5 && p5Intro && p5Main) {
            if (passengerPhase === "form") {
                p5Intro.classList.remove("hidden");
                p5Intro.hidden = false;
                p5Main.classList.add("hidden");
                p5Main.hidden = true;
            } else {
                p5Intro.classList.add("hidden");
                p5Intro.hidden = true;
                p5Main.classList.remove("hidden");
                p5Main.hidden = false;
            }
        }

        updateStepper();
        syncBookingToDom();
        updateBackVisibility();
    }

    function updateBackVisibility() {
        var back = $("#cb-back");
        if (!back) return;
        var hide = currentScreen === 1 && passengerPhase === "form";
        back.classList.toggle("invisible", hide);
        back.setAttribute("aria-hidden", hide ? "true" : "false");
        back.disabled = hide;
    }

    function stepEl(index) {
        return document.querySelector('[data-cb-step-index="' + index + '"]');
    }

    function setStepState(index, state) {
        var wrap = stepEl(index);
        if (!wrap) return;
        var circle = wrap.querySelector("[data-step-circle]");
        var label = wrap.querySelector("[data-step-label]");
        var num = wrap.querySelector("[data-step-num]");
        var check = wrap.querySelector("[data-step-check]");
        if (!circle || !label) return;

        circle.className =
            "flex h-9 w-9 shrink-0 items-center justify-center rounded border-2 text-sm font-bold transition-colors sm:h-10 sm:w-10";

        if (state === "done") {
            circle.classList.add("border-emerald-500", "bg-emerald-500", "text-white");
            if (num) num.classList.add("hidden");
            if (check) check.classList.remove("hidden");
            label.className =
                "mt-2 text-center text-[10px] font-medium text-white sm:text-xs " +
                "max-w-[4.5rem] leading-tight sm:max-w-[5.5rem]";
        } else if (state === "active") {
            circle.classList.add("border-white", "bg-white", "text-black");
            if (num) {
                num.classList.remove("hidden");
                num.textContent = String(index);
            }
            if (check) check.classList.add("hidden");
            label.className =
                "mt-2 text-center text-[10px] font-semibold text-white sm:text-xs " +
                "max-w-[4.5rem] leading-tight sm:max-w-[5.5rem]";
        } else {
            circle.classList.add("border-violet-300/80", "bg-violet-400/90", "text-white");
            if (num) {
                num.classList.remove("hidden");
                num.textContent = String(index);
            }
            if (check) check.classList.add("hidden");
            label.className =
                "mt-2 text-center text-[10px] font-medium text-violet-200 sm:text-xs " +
                "max-w-[4.5rem] leading-tight sm:max-w-[5.5rem]";
        }
    }

    function updateStepper() {
        var s1 = "upcoming";
        var s2 = "upcoming";
        var s3 = "upcoming";
        var s4 = "upcoming";

        if (currentScreen === 1) {
            s1 = "active";
        } else if (currentScreen === 2 || currentScreen === 3) {
            s1 = "done";
            s2 = "active";
        } else if (currentScreen === 4) {
            s1 = "done";
            s2 = "active";
        } else if (currentScreen === 5) {
            s1 = "done";
            s2 = "done";
            s3 = "active";
            s4 = "upcoming";
        } else if (currentScreen === 6) {
            s1 = "done";
            s2 = "done";
            s3 = "done";
            s4 = "active";
        }

        setStepState(1, s1);
        setStepState(2, s2);
        setStepState(3, s3);
        setStepState(4, s4);
    }

    function clearFlightError() {
        var err = $("#cb-flight-error-2");
        var inp = $("#cb-flight-input-2");
        if (err) err.classList.add("hidden");
        if (inp) {
            inp.classList.remove("border-red-500", "bg-red-50");
            inp.classList.add("border-sky-200", "bg-white");
        }
    }

    function showFlightError() {
        var err = $("#cb-flight-error-2");
        var inp = $("#cb-flight-input-2");
        if (err) err.classList.remove("hidden");
        if (inp) {
            inp.classList.add("border-red-500", "bg-red-50");
            inp.classList.remove("border-sky-200", "bg-white");
        }
    }

    function clearAirlineError() {
        var err = $("#cb-airline-error");
        var inp = $("#cb-airline");
        if (err) err.classList.add("hidden");
        if (inp) {
            inp.classList.remove("border-red-500", "bg-red-50");
            inp.classList.add("border-slate-200", "bg-white");
        }
    }

    function showAirlineError() {
        var err = $("#cb-airline-error");
        var inp = $("#cb-airline");
        if (err) err.classList.remove("hidden");
        if (inp) {
            inp.classList.add("border-red-500", "bg-red-50");
            inp.classList.remove("border-slate-200", "bg-white");
        }
    }

    function goNext() {
        readBookingFromDom();

        if (currentScreen === 1) {
            var v = flightInputPage1 ? flightInputPage1.value.trim() : "";
            if (flightInputPage2) flightInputPage2.value = v;
            showScreen(2);
            if (!isValidFlightNumber(v)) {
                showFlightError();
            } else {
                booking.flightNumber = v;
                clearFlightError();
            }
            return;
        }

        if (currentScreen === 2) {
            var v2 = flightInputPage2 ? flightInputPage2.value.trim() : "";
            if (!isValidFlightNumber(v2)) {
                showFlightError();
                return;
            }
            clearFlightError();
            booking.flightNumber = v2;
            showScreen(3);
            return;
        }

        if (currentScreen === 3) {
            var al = $("#cb-airline");
            var av = al ? al.value.trim() : "";
            if (!av) {
                showAirlineError();
                return;
            }
            clearAirlineError();
            booking.airline = av;
            readBookingFromForm();
            showScreen(4);
            return;
        }

        if (currentScreen === 4) {
            readBookingFromForm();
            passengerPhase = "form";
            showScreen(5);
            return;
        }

        if (currentScreen === 5) {
            if (passengerPhase === "form") {
                return;
            }
            showScreen(6);
            return;
        }
    }

    function readBookingFromDom() {
        readBookingFromForm();
    }

    function goBack() {
        if (currentScreen === 6) {
            passengerPhase = "done";
            showScreen(5);
            return;
        }
        if (currentScreen === 5 && passengerPhase === "done") {
            passengerPhase = "form";
            showScreen(5);
            return;
        }
        if (currentScreen === 5 && passengerPhase === "form") {
            showScreen(4);
            return;
        }
        if (currentScreen > 1) {
            showScreen(currentScreen - 1);
        }
    }

    var vehicleGalleryIndex = 0;
    var vehicleGallerySlideCount = 0;

    function vehicleGalleryUpdateTrack() {
        var track = $("#cb-vehicle-gallery-track");
        if (!track) return;
        track.style.transform = "translateX(-" + vehicleGalleryIndex * 100 + "%)";

        var dots = $("#cb-vehicle-gallery-dots");
        if (!dots) return;
        var dotBase =
            "rounded-full transition-all focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 ";
        $all("[data-cb-gallery-dot]", dots).forEach(function (btn, i) {
            var on = i === vehicleGalleryIndex;
            btn.className =
                dotBase +
                (on ? "h-2.5 w-6 bg-blue-600" : "h-2 w-2 bg-slate-300 hover:bg-slate-400");
            btn.setAttribute("aria-current", on ? "true" : "false");
        });
    }

    function vehicleGalleryGo(delta) {
        if (vehicleGallerySlideCount < 1) return;
        vehicleGalleryIndex =
            (vehicleGalleryIndex + delta + vehicleGallerySlideCount) % vehicleGallerySlideCount;
        vehicleGalleryUpdateTrack();
    }

    function vehicleGalleryOpen() {
        var layer = $("#cb-vehicle-gallery");
        if (!layer) return;
        vehicleGalleryIndex = 0;
        vehicleGalleryUpdateTrack();
        layer.classList.remove("hidden");
        layer.classList.add("flex");
        layer.setAttribute("aria-hidden", "false");
        document.body.style.overflow = "hidden";
        var closeBtn = $("#cb-vehicle-gallery-close");
        if (closeBtn) closeBtn.focus();
    }

    function vehicleGalleryClose() {
        var layer = $("#cb-vehicle-gallery");
        if (!layer) return;
        layer.classList.add("hidden");
        layer.classList.remove("flex");
        layer.setAttribute("aria-hidden", "true");
        document.body.style.overflow = "";
        var openBtn = $("#cb-vehicle-gallery-open");
        if (openBtn) openBtn.focus();
    }

    function initVehicleGallery() {
        var track = $("#cb-vehicle-gallery-track");
        var dotsWrap = $("#cb-vehicle-gallery-dots");
        if (!track || !dotsWrap) return;
        vehicleGallerySlideCount = track.querySelectorAll("figure").length;
        dotsWrap.innerHTML = "";
        for (var i = 0; i < vehicleGallerySlideCount; i++) {
            (function (idx) {
                var dot = document.createElement("button");
                dot.type = "button";
                dot.setAttribute("data-cb-gallery-dot", "");
                dot.setAttribute("aria-label", "Show image " + (idx + 1));
                dot.addEventListener("click", function () {
                    vehicleGalleryIndex = idx;
                    vehicleGalleryUpdateTrack();
                });
                dotsWrap.appendChild(dot);
            })(i);
        }
        vehicleGalleryUpdateTrack();

        var openBtn = $("#cb-vehicle-gallery-open");
        var closeBtn = $("#cb-vehicle-gallery-close");
        var prevBtn = $("#cb-vehicle-gallery-prev");
        var nextBtn = $("#cb-vehicle-gallery-next");
        var panel = $("#cb-vehicle-gallery-panel");
        var layer = $("#cb-vehicle-gallery");

        if (openBtn) {
            openBtn.addEventListener("click", function () {
                vehicleGalleryOpen();
            });
        }
        if (closeBtn) {
            closeBtn.addEventListener("click", function () {
                vehicleGalleryClose();
            });
        }
        if (prevBtn) {
            prevBtn.addEventListener("click", function () {
                vehicleGalleryGo(-1);
            });
        }
        if (nextBtn) {
            nextBtn.addEventListener("click", function () {
                vehicleGalleryGo(1);
            });
        }
        if (layer) {
            layer.addEventListener("click", function (e) {
                if (e.target === layer) vehicleGalleryClose();
            });
        }
        if (panel) {
            panel.addEventListener("click", function (e) {
                e.stopPropagation();
            });
        }

        document.addEventListener("keydown", function (e) {
            if (!layer || layer.classList.contains("hidden")) return;
            if (e.key === "Escape") {
                e.preventDefault();
                vehicleGalleryClose();
            } else if (e.key === "ArrowLeft") {
                vehicleGalleryGo(-1);
            } else if (e.key === "ArrowRight") {
                vehicleGalleryGo(1);
            }
        });
    }

    function onSendPassenger() {
        var name = $("#cb-contact-name");
        var email = $("#cb-contact-email");
        var phone = $("#cb-contact-phone");
        var nat = $("#cb-contact-nationality");
        var ne = name ? name.value.trim() : "";
        var em = email ? email.value.trim() : "";
        var ph = phone ? phone.value.trim() : "";
        var na = nat ? nat.value.trim() : "";

        var errName = $("#cb-contact-err-name");
        var errEmail = $("#cb-contact-err-email");
        var errPhone = $("#cb-contact-err-phone");
        [errName, errEmail, errPhone].forEach(function (e) {
            if (e) e.classList.add("hidden");
        });

        var ok = true;
        if (!ne) {
            if (errName) errName.classList.remove("hidden");
            ok = false;
        }
        if (!isValidEmail(em)) {
            if (errEmail) errEmail.classList.remove("hidden");
            ok = false;
        }
        if (!ph || ph.length < 6) {
            if (errPhone) errPhone.classList.remove("hidden");
            ok = false;
        }
        if (!ok) return;

        userInfo.name = ne;
        userInfo.email = em;
        userInfo.phone = ph;
        userInfo.nationality = na;
        passengerPhase = "done";
        syncBookingToDom();
        showScreen(5);
    }

    function init() {
        applyLimoPrefillFromServer();

        pages = $all("[data-cb-page]");
        flightInputPage1 = $("#cb-flight-input-1");
        flightInputPage2 = $("#cb-flight-input-2");

        var dateEl = $("#cb-pickup-date");
        if (dateEl && !dateEl.value) {
            dateEl.value = booking.pickupDate || todayIso();
        }
        if (dateEl && dateEl.value && !booking.pickupDate) {
            booking.pickupDate = dateEl.value;
        }
        var timeEl = $("#cb-pickup-time");
        if (timeEl && !timeEl.value) {
            timeEl.value = booking.pickupTime;
        }

        $all("[data-cb-next]").forEach(function (btn) {
            btn.addEventListener("click", function () {
                goNext();
            });
        });

        var sendBtn = $("#cb-send-contact");
        if (sendBtn) {
            sendBtn.addEventListener("click", function () {
                onSendPassenger();
            });
        }

        var back = $("#cb-back");
        if (back) {
            back.addEventListener("click", function () {
                goBack();
            });
        }

        var bookBtn = $("#cb-book-submit");
        if (bookBtn) {
            bookBtn.addEventListener("click", function () {
                var terms = $("#cb-terms");
                if (terms && !terms.checked) {
                    limoToast("error", "Please accept the terms and conditions.");
                    return;
                }
                submitLimoBooking(bookBtn);
            });
        }

        if (flightInputPage2) {
            flightInputPage2.addEventListener("input", function () {
                if (isValidFlightNumber(flightInputPage2.value.trim())) {
                    clearFlightError();
                }
            });
        }

        var airlineEl = $("#cb-airline");
        if (airlineEl) {
            airlineEl.addEventListener("input", function () {
                if (airlineEl.value.trim()) {
                    clearAirlineError();
                }
            });
        }

        ["cb-terminal", "cb-pickup-time", "cb-pickup-date"].forEach(function (id) {
            var el = $("#" + id);
            if (el) {
                el.addEventListener("change", function () {
                    readBookingFromForm();
                    syncBookingToDom();
                });
            }
        });

        syncBookingToDom();
        showScreen(1);
        initVehicleGallery();
        if (window.AOS && typeof window.AOS.init === "function") {
            window.AOS.init({
                duration: 700,
                once: true,
                easing: "ease-out-cubic"
            });
        }
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", init);
    } else {
        init();
    }
})();
