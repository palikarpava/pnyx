!function (e) {
    "function" == typeof define && define.amd ? define(["jquery", "jquery-mousewheel", "date-functions"], e) : "object" == typeof exports ? module.exports = e : e(jQuery)
}(function (e) {
    "use strict";
    function t(e, t, a) {
        this.date = e, this.desc = t, this.style = a
    }

    var a = {
        i18n: {
            ar: {
                months: ["كانون الثاني", "شباط", "آذار", "نيسان", "مايو", "حزيران", "تموز", "آب", "أيلول", "تشرين الأول", "تشرين الثاني", "كانون الأول"],
                dayOfWeekShort: ["ن", "ث", "ع", "خ", "ج", "س", "ح"],
                dayOfWeek: ["الأحد", "الاثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة", "السبت", "الأحد"]
            },
            ro: {
                months: ["Ianuarie", "Februarie", "Martie", "Aprilie", "Mai", "Iunie", "Iulie", "August", "Septembrie", "Octombrie", "Noiembrie", "Decembrie"],
                dayOfWeekShort: ["Du", "Lu", "Ma", "Mi", "Jo", "Vi", "Sâ"],
                dayOfWeek: ["Duminică", "Luni", "Marţi", "Miercuri", "Joi", "Vineri", "Sâmbătă"]
            },
            id: {months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"], dayOfWeekShort: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"], dayOfWeek: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"]},
            is: {
                months: ["Janúar", "Febrúar", "Mars", "Apríl", "Maí", "Júní", "Júlí", "Ágúst", "September", "Október", "Nóvember", "Desember"],
                dayOfWeekShort: ["Sun", "Mán", "Þrið", "Mið", "Fim", "Fös", "Lau"],
                dayOfWeek: ["Sunnudagur", "Mánudagur", "Þriðjudagur", "Miðvikudagur", "Fimmtudagur", "Föstudagur", "Laugardagur"]
            },
            bg: {months: ["Януари", "Февруари", "Март", "Април", "Май", "Юни", "Юли", "Август", "Септември", "Октомври", "Ноември", "Декември"], dayOfWeekShort: ["Нд", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"], dayOfWeek: ["Неделя", "Понеделник", "Вторник", "Сряда", "Четвъртък", "Петък", "Събота"]},
            fa: {
                months: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"],
                dayOfWeekShort: ["یکشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنجشنبه", "جمعه", "شنبه"],
                dayOfWeek: ["یک‌شنبه", "دوشنبه", "سه‌شنبه", "چهارشنبه", "پنج‌شنبه", "جمعه", "شنبه", "یک‌شنبه"]
            },
            ru: {months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"], dayOfWeekShort: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"], dayOfWeek: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"]},
            uk: {
                months: ["Січень", "Лютий", "Березень", "Квітень", "Травень", "Червень", "Липень", "Серпень", "Вересень", "Жовтень", "Листопад", "Грудень"],
                dayOfWeekShort: ["Ндл", "Пнд", "Втр", "Срд", "Чтв", "Птн", "Сбт"],
                dayOfWeek: ["Неділя", "Понеділок", "Вівторок", "Середа", "Четвер", "П'ятниця", "Субота"]
            },
            en: {
                months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                dayOfWeekShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                dayOfWeek: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
            },
            el: {
                months: ["Ιανουάριος", "Φεβρουάριος", "Μάρτιος", "Απρίλιος", "Μάιος", "Ιούνιος", "Ιούλιος", "Αύγουστος", "Σεπτέμβριος", "Οκτώβριος", "Νοέμβριος", "Δεκέμβριος"],
                dayOfWeekShort: ["Κυρ", "Δευ", "Τρι", "Τετ", "Πεμ", "Παρ", "Σαβ"],
                dayOfWeek: ["Κυριακή", "Δευτέρα", "Τρίτη", "Τετάρτη", "Πέμπτη", "Παρασκευή", "Σάββατο"]
            },
            de: {months: ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"], dayOfWeekShort: ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"], dayOfWeek: ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"]},
            nl: {
                months: ["januari", "februari", "maart", "april", "mei", "juni", "juli", "augustus", "september", "oktober", "november", "december"],
                dayOfWeekShort: ["zo", "ma", "di", "wo", "do", "vr", "za"],
                dayOfWeek: ["zondag", "maandag", "dinsdag", "woensdag", "donderdag", "vrijdag", "zaterdag"]
            },
            tr: {months: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"], dayOfWeekShort: ["Paz", "Pts", "Sal", "Çar", "Per", "Cum", "Cts"], dayOfWeek: ["Pazar", "Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi"]},
            fr: {
                months: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
                dayOfWeekShort: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
                dayOfWeek: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"]
            },
            es: {
                months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                dayOfWeekShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
                dayOfWeek: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"]
            },
            th: {
                months: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"],
                dayOfWeekShort: ["อา.", "จ.", "อ.", "พ.", "พฤ.", "ศ.", "ส."],
                dayOfWeek: ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัส", "ศุกร์", "เสาร์", "อาทิตย์"]
            },
            pl: {
                months: ["styczeń", "luty", "marzec", "kwiecień", "maj", "czerwiec", "lipiec", "sierpień", "wrzesień", "październik", "listopad", "grudzień"],
                dayOfWeekShort: ["nd", "pn", "wt", "śr", "cz", "pt", "sb"],
                dayOfWeek: ["niedziela", "poniedziałek", "wtorek", "środa", "czwartek", "piątek", "sobota"]
            },
            pt: {
                months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
                dayOfWeekShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
                dayOfWeek: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"]
            },
            ch: {months: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"], dayOfWeekShort: ["日", "一", "二", "三", "四", "五", "六"]},
            se: {months: ["Januari", "Februari", "Mars", "April", "Maj", "Juni", "Juli", "Augusti", "September", "Oktober", "November", "December"], dayOfWeekShort: ["Sön", "Mån", "Tis", "Ons", "Tor", "Fre", "Lör"]},
            kr: {months: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"], dayOfWeekShort: ["일", "월", "화", "수", "목", "금", "토"], dayOfWeek: ["일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일"]},
            it: {
                months: ["Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"],
                dayOfWeekShort: ["Dom", "Lun", "Mar", "Mer", "Gio", "Ven", "Sab"],
                dayOfWeek: ["Domenica", "Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdì", "Sabato"]
            },
            da: {months: ["January", "Februar", "Marts", "April", "Maj", "Juni", "July", "August", "September", "Oktober", "November", "December"], dayOfWeekShort: ["Søn", "Man", "Tir", "Ons", "Tor", "Fre", "Lør"], dayOfWeek: ["søndag", "mandag", "tirsdag", "onsdag", "torsdag", "fredag", "lørdag"]},
            no: {months: ["Januar", "Februar", "Mars", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Desember"], dayOfWeekShort: ["Søn", "Man", "Tir", "Ons", "Tor", "Fre", "Lør"], dayOfWeek: ["Søndag", "Mandag", "Tirsdag", "Onsdag", "Torsdag", "Fredag", "Lørdag"]},
            ja: {months: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"], dayOfWeekShort: ["日", "月", "火", "水", "木", "金", "土"], dayOfWeek: ["日曜", "月曜", "火曜", "水曜", "木曜", "金曜", "土曜"]},
            vi: {
                months: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                dayOfWeekShort: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
                dayOfWeek: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"]
            },
            sl: {
                months: ["Januar", "Februar", "Marec", "April", "Maj", "Junij", "Julij", "Avgust", "September", "Oktober", "November", "December"],
                dayOfWeekShort: ["Ned", "Pon", "Tor", "Sre", "Čet", "Pet", "Sob"],
                dayOfWeek: ["Nedelja", "Ponedeljek", "Torek", "Sreda", "Četrtek", "Petek", "Sobota"]
            },
            cs: {months: ["Leden", "Únor", "Březen", "Duben", "Květen", "Červen", "Červenec", "Srpen", "Září", "Říjen", "Listopad", "Prosinec"], dayOfWeekShort: ["Ne", "Po", "Út", "St", "Čt", "Pá", "So"]},
            hu: {
                months: ["Január", "Február", "Március", "Április", "Május", "Június", "Július", "Augusztus", "Szeptember", "Október", "November", "December"],
                dayOfWeekShort: ["Va", "Hé", "Ke", "Sze", "Cs", "Pé", "Szo"],
                dayOfWeek: ["vasárnap", "hétfő", "kedd", "szerda", "csütörtök", "péntek", "szombat"]
            },
            az: {months: ["Yanvar", "Fevral", "Mart", "Aprel", "May", "Iyun", "Iyul", "Avqust", "Sentyabr", "Oktyabr", "Noyabr", "Dekabr"], dayOfWeekShort: ["B", "Be", "Ça", "Ç", "Ca", "C", "Ş"], dayOfWeek: ["Bazar", "Bazar ertəsi", "Çərşənbə axşamı", "Çərşənbə", "Cümə axşamı", "Cümə", "Şənbə"]},
            bs: {
                months: ["Januar", "Februar", "Mart", "April", "Maj", "Jun", "Jul", "Avgust", "Septembar", "Oktobar", "Novembar", "Decembar"],
                dayOfWeekShort: ["Ned", "Pon", "Uto", "Sri", "Čet", "Pet", "Sub"],
                dayOfWeek: ["Nedjelja", "Ponedjeljak", "Utorak", "Srijeda", "Četvrtak", "Petak", "Subota"]
            },
            ca: {months: ["Gener", "Febrer", "Març", "Abril", "Maig", "Juny", "Juliol", "Agost", "Setembre", "Octubre", "Novembre", "Desembre"], dayOfWeekShort: ["Dg", "Dl", "Dt", "Dc", "Dj", "Dv", "Ds"], dayOfWeek: ["Diumenge", "Dilluns", "Dimarts", "Dimecres", "Dijous", "Divendres", "Dissabte"]},
            "en-GB": {
                months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                dayOfWeekShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                dayOfWeek: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
            },
            et: {
                months: ["Jaanuar", "Veebruar", "Märts", "Aprill", "Mai", "Juuni", "Juuli", "August", "September", "Oktoober", "November", "Detsember"],
                dayOfWeekShort: ["P", "E", "T", "K", "N", "R", "L"],
                dayOfWeek: ["Pühapäev", "Esmaspäev", "Teisipäev", "Kolmapäev", "Neljapäev", "Reede", "Laupäev"]
            },
            eu: {
                months: ["Urtarrila", "Otsaila", "Martxoa", "Apirila", "Maiatza", "Ekaina", "Uztaila", "Abuztua", "Iraila", "Urria", "Azaroa", "Abendua"],
                dayOfWeekShort: ["Ig.", "Al.", "Ar.", "Az.", "Og.", "Or.", "La."],
                dayOfWeek: ["Igandea", "Astelehena", "Asteartea", "Asteazkena", "Osteguna", "Ostirala", "Larunbata"]
            },
            fi: {
                months: ["Tammikuu", "Helmikuu", "Maaliskuu", "Huhtikuu", "Toukokuu", "Kesäkuu", "Heinäkuu", "Elokuu", "Syyskuu", "Lokakuu", "Marraskuu", "Joulukuu"],
                dayOfWeekShort: ["Su", "Ma", "Ti", "Ke", "To", "Pe", "La"],
                dayOfWeek: ["sunnuntai", "maanantai", "tiistai", "keskiviikko", "torstai", "perjantai", "lauantai"]
            },
            gl: {months: ["Xan", "Feb", "Maz", "Abr", "Mai", "Xun", "Xul", "Ago", "Set", "Out", "Nov", "Dec"], dayOfWeekShort: ["Dom", "Lun", "Mar", "Mer", "Xov", "Ven", "Sab"], dayOfWeek: ["Domingo", "Luns", "Martes", "Mércores", "Xoves", "Venres", "Sábado"]},
            hr: {
                months: ["Siječanj", "Veljača", "Ožujak", "Travanj", "Svibanj", "Lipanj", "Srpanj", "Kolovoz", "Rujan", "Listopad", "Studeni", "Prosinac"],
                dayOfWeekShort: ["Ned", "Pon", "Uto", "Sri", "Čet", "Pet", "Sub"],
                dayOfWeek: ["Nedjelja", "Ponedjeljak", "Utorak", "Srijeda", "Četvrtak", "Petak", "Subota"]
            },
            ko: {months: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"], dayOfWeekShort: ["일", "월", "화", "수", "목", "금", "토"], dayOfWeek: ["일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일"]},
            lt: {
                months: ["Sausio", "Vasario", "Kovo", "Balandžio", "Gegužės", "Birželio", "Liepos", "Rugpjūčio", "Rugsėjo", "Spalio", "Lapkričio", "Gruodžio"],
                dayOfWeekShort: ["Sek", "Pir", "Ant", "Tre", "Ket", "Pen", "Šeš"],
                dayOfWeek: ["Sekmadienis", "Pirmadienis", "Antradienis", "Trečiadienis", "Ketvirtadienis", "Penktadienis", "Šeštadienis"]
            },
            lv: {
                months: ["Janvāris", "Februāris", "Marts", "Aprīlis ", "Maijs", "Jūnijs", "Jūlijs", "Augusts", "Septembris", "Oktobris", "Novembris", "Decembris"],
                dayOfWeekShort: ["Sv", "Pr", "Ot", "Tr", "Ct", "Pk", "St"],
                dayOfWeek: ["Svētdiena", "Pirmdiena", "Otrdiena", "Trešdiena", "Ceturtdiena", "Piektdiena", "Sestdiena"]
            },
            mk: {
                months: ["јануари", "февруари", "март", "април", "мај", "јуни", "јули", "август", "септември", "октомври", "ноември", "декември"],
                dayOfWeekShort: ["нед", "пон", "вто", "сре", "чет", "пет", "саб"],
                dayOfWeek: ["Недела", "Понеделник", "Вторник", "Среда", "Четврток", "Петок", "Сабота"]
            },
            mn: {
                months: ["1-р сар", "2-р сар", "3-р сар", "4-р сар", "5-р сар", "6-р сар", "7-р сар", "8-р сар", "9-р сар", "10-р сар", "11-р сар", "12-р сар"],
                dayOfWeekShort: ["Дав", "Мяг", "Лха", "Пүр", "Бсн", "Бям", "Ням"],
                dayOfWeek: ["Даваа", "Мягмар", "Лхагва", "Пүрэв", "Баасан", "Бямба", "Ням"]
            },
            "pt-BR": {
                months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
                dayOfWeekShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
                dayOfWeek: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"]
            },
            sk: {months: ["Január", "Február", "Marec", "Apríl", "Máj", "Jún", "Júl", "August", "September", "Október", "November", "December"], dayOfWeekShort: ["Ne", "Po", "Ut", "St", "Št", "Pi", "So"], dayOfWeek: ["Nedeľa", "Pondelok", "Utorok", "Streda", "Štvrtok", "Piatok", "Sobota"]},
            sq: {
                months: ["Janar", "Shkurt", "Mars", "Prill", "Maj", "Qershor", "Korrik", "Gusht", "Shtator", "Tetor", "Nëntor", "Dhjetor"],
                dayOfWeekShort: ["Die", "Hën", "Mar", "Mër", "Enj", "Pre", "Shtu"],
                dayOfWeek: ["E Diel", "E Hënë", "E Martē", "E Mërkurë", "E Enjte", "E Premte", "E Shtunë"]
            },
            "sr-YU": {
                months: ["Januar", "Februar", "Mart", "April", "Maj", "Jun", "Jul", "Avgust", "Septembar", "Oktobar", "Novembar", "Decembar"],
                dayOfWeekShort: ["Ned", "Pon", "Uto", "Sre", "čet", "Pet", "Sub"],
                dayOfWeek: ["Nedelja", "Ponedeljak", "Utorak", "Sreda", "Četvrtak", "Petak", "Subota"]
            },
            sr: {months: ["јануар", "фебруар", "март", "април", "мај", "јун", "јул", "август", "септембар", "октобар", "новембар", "децембар"], dayOfWeekShort: ["нед", "пон", "уто", "сре", "чет", "пет", "суб"], dayOfWeek: ["Недеља", "Понедељак", "Уторак", "Среда", "Четвртак", "Петак", "Субота"]},
            sv: {months: ["Januari", "Februari", "Mars", "April", "Maj", "Juni", "Juli", "Augusti", "September", "Oktober", "November", "December"], dayOfWeekShort: ["Sön", "Mån", "Tis", "Ons", "Tor", "Fre", "Lör"], dayOfWeek: ["Söndag", "Måndag", "Tisdag", "Onsdag", "Torsdag", "Fredag", "Lördag"]},
            "zh-TW": {months: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"], dayOfWeekShort: ["日", "一", "二", "三", "四", "五", "六"], dayOfWeek: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"]},
            zh: {months: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"], dayOfWeekShort: ["日", "一", "二", "三", "四", "五", "六"], dayOfWeek: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"]},
            he: {months: ["ינואר", "פברואר", "מרץ", "אפריל", "מאי", "יוני", "יולי", "אוגוסט", "ספטמבר", "אוקטובר", "נובמבר", "דצמבר"], dayOfWeekShort: ["א'", "ב'", "ג'", "ד'", "ה'", "ו'", "שבת"], dayOfWeek: ["ראשון", "שני", "שלישי", "רביעי", "חמישי", "שישי", "שבת", "ראשון"]},
            hy: {
                months: ["Հունվար", "Փետրվար", "Մարտ", "Ապրիլ", "Մայիս", "Հունիս", "Հուլիս", "Օգոստոս", "Սեպտեմբեր", "Հոկտեմբեր", "Նոյեմբեր", "Դեկտեմբեր"],
                dayOfWeekShort: ["Կի", "Երկ", "Երք", "Չոր", "Հնգ", "Ուրբ", "Շբթ"],
                dayOfWeek: ["Կիրակի", "Երկուշաբթի", "Երեքշաբթի", "Չորեքշաբթի", "Հինգշաբթի", "Ուրբաթ", "Շաբաթ"]
            },
            kg: {
                months: ["Үчтүн айы", "Бирдин айы", "Жалган Куран", "Чын Куран", "Бугу", "Кулжа", "Теке", "Баш Оона", "Аяк Оона", "Тогуздун айы", "Жетинин айы", "Бештин айы"],
                dayOfWeekShort: ["Жек", "Дүй", "Шей", "Шар", "Бей", "Жум", "Ише"],
                dayOfWeek: ["Жекшемб", "Дүйшөмб", "Шейшемб", "Шаршемб", "Бейшемби", "Жума", "Ишенб"]
            }
        },
        value: "",
        rtl: !1,
        format: "Y/m/d H:i",
        formatTime: "H:i",
        formatDate: "Y/m/d",
        startDate: !1,
        step: 60,
        monthChangeSpinner: !0,
        closeOnDateSelect: !1,
        closeOnTimeSelect: !0,
        closeOnWithoutClick: !0,
        closeOnInputClick: !0,
        timepicker: !0,
        datepicker: !0,
        weeks: !1,
        defaultTime: !1,
        defaultDate: !1,
        minDate: !1,
        maxDate: !1,
        minTime: !1,
        maxTime: !1,
        disabledMinTime: !1,
        disabledMaxTime: !1,
        allowTimes: [],
        opened: !1,
        initTime: !0,
        inline: !1,
        theme: "",
        onSelectDate: function () {
        },
        onSelectTime: function () {
        },
        onChangeMonth: function () {
        },
        onChangeYear: function () {
        },
        onChangeDateTime: function () {
        },
        onShow: function () {
        },
        onClose: function () {
        },
        onGenerate: function () {
        },
        withoutCopyright: !0,
        inverseButton: !1,
        hours12: !1,
        next: "xdsoft_next",
        prev: "xdsoft_prev",
        dayOfWeekStart: 0,
        parentID: "body",
        timeHeightInTimePicker: 25,
        timepickerScrollbar: !0,
        todayButton: !0,
        prevButton: !0,
        nextButton: !0,
        defaultSelect: !0,
        scrollMonth: !0,
        scrollTime: !0,
        scrollInput: !0,
        lazyInit: !1,
        mask: !1,
        validateOnBlur: !0,
        allowBlank: !0,
        yearStart: 1950,
        yearEnd: 2050,
        monthStart: 0,
        monthEnd: 11,
        style: "",
        id: "",
        fixed: !1,
        roundTime: "round",
        className: "",
        weekends: [],
        highlightedDates: [],
        highlightedPeriods: [],
        disabledDates: [],
        disabledWeekDays: [],
        yearOffset: 0,
        beforeShowDay: null,
        enterLikeTab: !0,
        showApplyButton: !1
    }, n = "en", r = "en";
    e.datetimepicker = {
        setLocale: function (e) {
            r = a.i18n[e] ? e : n, Date.monthNames = a.i18n[r].months, Date.dayNames = a.i18n[r].dayOfWeek
        }
    }, window.getComputedStyle || (window.getComputedStyle = function (e) {
        return this.el = e, this.getPropertyValue = function (t) {
            var a = /(\-([a-z]){1})/g;
            return "float" === t && (t = "styleFloat"), a.test(t) && (t = t.replace(a, function (e, t, a) {
                return a.toUpperCase()
            })), e.currentStyle[t] || null
        }, this
    }), Array.prototype.indexOf || (Array.prototype.indexOf = function (e, t) {
        var a, n;
        for (a = t || 0, n = this.length; n > a; a += 1)if (this[a] === e)return a;
        return -1
    }), Date.prototype.countDaysInMonth = function () {
        return new Date(this.getFullYear(), this.getMonth() + 1, 0).getDate()
    }, e.fn.xdsoftScroller = function (t) {
        return this.each(function () {
            var a, n, r, o, i, s = e(this), d = function (e) {
                var t, a = {x: 0, y: 0};
                return "touchstart" === e.type || "touchmove" === e.type || "touchend" === e.type || "touchcancel" === e.type ? (t = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0], a.x = t.clientX, a.y = t.clientY) : ("mousedown" === e.type || "mouseup" === e.type || "mousemove" === e.type || "mouseover" === e.type || "mouseout" === e.type || "mouseenter" === e.type || "mouseleave" === e.type) && (a.x = e.clientX, a.y = e.clientY), a
            }, u = 100, l = !1, f = 0, c = 0, h = 0, m = !1, g = 0, p = function () {
            };
            return "hide" === t ? void s.find(".xdsoft_scrollbar").hide() : (e(this).hasClass("xdsoft_scroller_box") || (a = s.children().eq(0), n = s[0].clientHeight, r = a[0].offsetHeight, o = e('<div class="xdsoft_scrollbar"></div>'), i = e('<div class="xdsoft_scroller"></div>'), o.append(i), s.addClass("xdsoft_scroller_box").append(o), p = function (e) {
                var t = d(e).y - f + g;
                0 > t && (t = 0), t + i[0].offsetHeight > h && (t = h - i[0].offsetHeight), s.trigger("scroll_element.xdsoft_scroller", [u ? t / u : 0])
            }, i.on("touchstart.xdsoft_scroller mousedown.xdsoft_scroller", function (a) {
                n || s.trigger("resize_scroll.xdsoft_scroller", [t]), f = d(a).y, g = parseInt(i.css("margin-top"), 10), h = o[0].offsetHeight, "mousedown" === a.type ? (document && e(document.body).addClass("xdsoft_noselect"), e([document.body, window]).on("mouseup.xdsoft_scroller", function r() {
                    e([document.body, window]).off("mouseup.xdsoft_scroller", r).off("mousemove.xdsoft_scroller", p).removeClass("xdsoft_noselect")
                }), e(document.body).on("mousemove.xdsoft_scroller", p)) : (m = !0, a.stopPropagation(), a.preventDefault())
            }).on("touchmove", function (e) {
                m && (e.preventDefault(), p(e))
            }).on("touchend touchcancel", function () {
                m = !1, g = 0
            }), s.on("scroll_element.xdsoft_scroller", function (e, t) {
                n || s.trigger("resize_scroll.xdsoft_scroller", [t, !0]), t = t > 1 ? 1 : 0 > t || isNaN(t) ? 0 : t, i.css("margin-top", u * t), setTimeout(function () {
                    a.css("marginTop", -parseInt((a[0].offsetHeight - n) * t, 10))
                }, 10)
            }).on("resize_scroll.xdsoft_scroller", function (e, t, d) {
                var l, f;
                n = s[0].clientHeight, r = a[0].offsetHeight, l = n / r, f = l * o[0].offsetHeight, l > 1 ? i.hide() : (i.show(), i.css("height", parseInt(f > 10 ? f : 10, 10)), u = o[0].offsetHeight - i[0].offsetHeight, d !== !0 && s.trigger("scroll_element.xdsoft_scroller", [t || Math.abs(parseInt(a.css("marginTop"), 10)) / (r - n)]))
            }), s.on("mousewheel", function (e) {
                var t = Math.abs(parseInt(a.css("marginTop"), 10));
                return t -= 20 * e.deltaY, 0 > t && (t = 0), s.trigger("scroll_element.xdsoft_scroller", [t / (r - n)]), e.stopPropagation(), !1
            }), s.on("touchstart", function (e) {
                l = d(e), c = Math.abs(parseInt(a.css("marginTop"), 10))
            }), s.on("touchmove", function (e) {
                if (l) {
                    e.preventDefault();
                    var t = d(e);
                    s.trigger("scroll_element.xdsoft_scroller", [(c - (t.y - l.y)) / (r - n)])
                }
            }), s.on("touchend touchcancel", function () {
                l = !1, c = 0
            })), void s.trigger("resize_scroll.xdsoft_scroller", [t]))
        })
    }, e.fn.datetimepicker = function (n) {
        var o, i, s = 48, d = 57, u = 96, l = 105, f = 17, c = 46, h = 13, m = 27, g = 8, p = 37, y = 38, D = 39, v = 40, b = 9, x = 116, k = 65, T = 67, S = 86, M = 90, O = 89, w = !1, _ = e.isPlainObject(n) || !n ? e.extend(!0, {}, a, n) : e.extend(!0, {}, a), W = 0, F = function (e) {
            e.on("open.xdsoft focusin.xdsoft mousedown.xdsoft", function t() {
                e.is(":disabled") || e.data("xdsoft_datetimepicker") || (clearTimeout(W), W = setTimeout(function () {
                    e.data("xdsoft_datetimepicker") || o(e), e.off("open.xdsoft focusin.xdsoft mousedown.xdsoft", t).trigger("open.xdsoft")
                }, 100))
            })
        };
        return o = function (a) {
            function o() {
                var e, t = !1;
                return _.startDate ? t = C.strToDate(_.startDate) : (t = _.value || (a && a.val && a.val() ? a.val() : ""), t ? t = C.strToDateTime(t) : _.defaultDate && (t = C.strToDateTime(_.defaultDate), _.defaultTime && (e = C.strtotime(_.defaultTime), t.setHours(e.getHours()), t.setMinutes(e.getMinutes())))), t && C.isValidDate(t) ? Y.data("changed", !0) : t = "", t || 0
            }

            var i, W, F, A, P, C, Y = e('<div class="xdsoft_datetimepicker xdsoft_noselect"></div>'), j = e('<div class="xdsoft_copyright"><a target="_blank" href="http://xdsoft.net/jqplugins/datetimepicker/">xdsoft.net</a></div>'), J = e('<div class="xdsoft_datepicker active"></div>'), z = e('<div class="xdsoft_mounthpicker"><button type="button" class="xdsoft_prev"></button><button type="button" class="xdsoft_today_button"></button><div class="xdsoft_label xdsoft_month"><span></span><i></i></div><div class="xdsoft_label xdsoft_year"><span></span><i></i></div><button type="button" class="xdsoft_next"></button></div>'), H = e('<div class="xdsoft_calendar"></div>'), I = e('<div class="xdsoft_timepicker active"><button type="button" class="xdsoft_prev"></button><div class="xdsoft_time_box"></div><button type="button" class="xdsoft_next"></button></div>'), N = I.find(".xdsoft_time_box").eq(0), L = e('<div class="xdsoft_time_variant"></div>'), E = e('<button type="button" class="xdsoft_save_selected blue-gradient-button">Save Selected</button>'), B = e('<div class="xdsoft_select xdsoft_monthselect"><div></div></div>'), V = e('<div class="xdsoft_select xdsoft_yearselect"><div></div></div>'), R = !1, q = 0, G = 0;
            _.id && Y.attr("id", _.id), _.style && Y.attr("style", _.style), _.weeks && Y.addClass("xdsoft_showweeks"), _.rtl && Y.addClass("xdsoft_rtl"), Y.addClass("xdsoft_" + _.theme), Y.addClass(_.className), z.find(".xdsoft_month span").after(B), z.find(".xdsoft_year span").after(V), z.find(".xdsoft_month,.xdsoft_year").on("mousedown.xdsoft", function (t) {
                var a, n, r = e(this).find(".xdsoft_select").eq(0), o = 0, i = 0, s = r.is(":visible");
                for (z.find(".xdsoft_select").hide(), C.currentTime && (o = C.currentTime[e(this).hasClass("xdsoft_month") ? "getMonth" : "getFullYear"]()), r[s ? "hide" : "show"](), a = r.find("div.xdsoft_option"), n = 0; n < a.length && a.eq(n).data("value") !== o; n += 1)i += a[0].offsetHeight;
                return r.xdsoftScroller(i / (r.children()[0].offsetHeight - r[0].clientHeight)), t.stopPropagation(), !1
            }), z.find(".xdsoft_select").xdsoftScroller().on("mousedown.xdsoft", function (e) {
                e.stopPropagation(), e.preventDefault()
            }).on("mousedown.xdsoft", ".xdsoft_option", function () {
                (void 0 === C.currentTime || null === C.currentTime) && (C.currentTime = C.now());
                var t = C.currentTime.getFullYear();
                C && C.currentTime && C.currentTime[e(this).parent().parent().hasClass("xdsoft_monthselect") ? "setMonth" : "setFullYear"](e(this).data("value")), e(this).parent().parent().hide(), Y.trigger("xchange.xdsoft"), _.onChangeMonth && e.isFunction(_.onChangeMonth) && _.onChangeMonth.call(Y, C.currentTime, Y.data("input")), t !== C.currentTime.getFullYear() && e.isFunction(_.onChangeYear) && _.onChangeYear.call(Y, C.currentTime, Y.data("input"))
            }), Y.setOptions = function (n) {
                var r = {}, o = function (e) {
                    try {
                        if (document.selection && document.selection.createRange) {
                            var t = document.selection.createRange();
                            return t.getBookmark().charCodeAt(2) - 2
                        }
                        if (e.setSelectionRange)return e.selectionStart
                    } catch (a) {
                        return 0
                    }
                }, i = function (e, t) {
                    if (e = "string" == typeof e || e instanceof String ? document.getElementById(e) : e, !e)return !1;
                    if (e.createTextRange) {
                        var a = e.createTextRange();
                        return a.collapse(!0), a.moveEnd("character", t), a.moveStart("character", t), a.select(), !0
                    }
                    return e.setSelectionRange ? (e.setSelectionRange(t, t), !0) : !1
                }, W = function (e, t) {
                    var a = e.replace(/([\[\]\/\{\}\(\)\-\.\+]{1})/g, "\\$1").replace(/_/g, "{digit+}").replace(/([0-9]{1})/g, "{digit$1}").replace(/\{digit([0-9]{1})\}/g, "[0-$1_]{1}").replace(/\{digit[\+]\}/g, "[0-9_]{1}");
                    return new RegExp(a).test(t)
                };
                _ = e.extend(!0, {}, _, n), n.allowTimes && e.isArray(n.allowTimes) && n.allowTimes.length && (_.allowTimes = e.extend(!0, [], n.allowTimes)), n.weekends && e.isArray(n.weekends) && n.weekends.length && (_.weekends = e.extend(!0, [], n.weekends)), n.highlightedDates && e.isArray(n.highlightedDates) && n.highlightedDates.length && (e.each(n.highlightedDates, function (a, n) {
                    var o, i = e.map(n.split(","), e.trim), s = new t(Date.parseDate(i[0], _.formatDate), i[1], i[2]), d = s.date.dateFormat(_.formatDate);
                    void 0 !== r[d] ? (o = r[d].desc, o && o.length && s.desc && s.desc.length && (r[d].desc = o + "\n" + s.desc)) : r[d] = s
                }), _.highlightedDates = e.extend(!0, [], r)), n.highlightedPeriods && e.isArray(n.highlightedPeriods) && n.highlightedPeriods.length && (r = e.extend(!0, [], _.highlightedDates), e.each(n.highlightedPeriods, function (a, n) {
                    var o, i, s, d, u, l, f;
                    if (e.isArray(n))o = n[0], i = n[1], s = n[2], f = n[3]; else {
                        var c = e.map(n.split(","), e.trim);
                        o = Date.parseDate(c[0], _.formatDate), i = Date.parseDate(c[1], _.formatDate), s = c[2], f = c[3]
                    }
                    for (; i >= o;)d = new t(o, s, f), u = o.dateFormat(_.formatDate), o.setDate(o.getDate() + 1), void 0 !== r[u] ? (l = r[u].desc, l && l.length && d.desc && d.desc.length && (r[u].desc = l + "\n" + d.desc)) : r[u] = d
                }), _.highlightedDates = e.extend(!0, [], r)), n.disabledDates && e.isArray(n.disabledDates) && n.disabledDates.length && (_.disabledDates = e.extend(!0, [], n.disabledDates)), n.disabledWeekDays && e.isArray(n.disabledWeekDays) && n.disabledWeekDays.length && (_.disabledWeekDays = e.extend(!0, [], n.disabledWeekDays)), !_.open && !_.opened || _.inline || a.trigger("open.xdsoft"), _.inline && (R = !0, Y.addClass("xdsoft_inline"), a.after(Y).hide()), _.inverseButton && (_.next = "xdsoft_prev", _.prev = "xdsoft_next"), _.datepicker ? J.addClass("active") : J.removeClass("active"), _.timepicker ? I.addClass("active") : I.removeClass("active"), _.value && (C.setCurrentTime(_.value), a && a.val && a.val(C.str)), _.dayOfWeekStart = isNaN(_.dayOfWeekStart) ? 0 : parseInt(_.dayOfWeekStart, 10) % 7, _.timepickerScrollbar || N.xdsoftScroller("hide"), _.minDate && /^[\+\-](.*)$/.test(_.minDate) && (_.minDate = C.strToDateTime(_.minDate).dateFormat(_.formatDate)), _.maxDate && /^[\+\-](.*)$/.test(_.maxDate) && (_.maxDate = C.strToDateTime(_.maxDate).dateFormat(_.formatDate)), E.toggle(_.showApplyButton), z.find(".xdsoft_today_button").css("visibility", _.todayButton ? "visible" : "hidden"), z.find("." + _.prev).css("visibility", _.prevButton ? "visible" : "hidden"), z.find("." + _.next).css("visibility", _.nextButton ? "visible" : "hidden"), _.mask && (a.off("keydown.xdsoft"), _.mask === !0 && (_.mask = _.format.replace(/Y/g, "9999").replace(/F/g, "9999").replace(/m/g, "19").replace(/d/g, "39").replace(/H/g, "29").replace(/i/g, "59").replace(/s/g, "59")), "string" === e.type(_.mask) && (W(_.mask, a.val()) || a.val(_.mask.replace(/[0-9]/g, "_")), a.on("keydown.xdsoft", function (t) {
                    var n, r, F = this.value, A = t.which;
                    if (A >= s && d >= A || A >= u && l >= A || A === g || A === c) {
                        for (n = o(this), r = A !== g && A !== c ? String.fromCharCode(A >= u && l >= A ? A - s : A) : "_", A !== g && A !== c || !n || (n -= 1, r = "_"); /[^0-9_]/.test(_.mask.substr(n, 1)) && n < _.mask.length && n > 0;)n += A === g || A === c ? -1 : 1;
                        if (F = F.substr(0, n) + r + F.substr(n + 1), "" === e.trim(F))F = _.mask.replace(/[0-9]/g, "_"); else if (n === _.mask.length)return t.preventDefault(), !1;
                        for (n += A === g || A === c ? 0 : 1; /[^0-9_]/.test(_.mask.substr(n, 1)) && n < _.mask.length && n > 0;)n += A === g || A === c ? -1 : 1;
                        W(_.mask, F) ? (this.value = F, i(this, n)) : "" === e.trim(F) ? this.value = _.mask.replace(/[0-9]/g, "_") : a.trigger("error_input.xdsoft")
                    } else if (-1 !== [k, T, S, M, O].indexOf(A) && w || -1 !== [m, y, v, p, D, x, f, b, h].indexOf(A))return !0;
                    return t.preventDefault(), !1
                }))), _.validateOnBlur && a.off("blur.xdsoft").on("blur.xdsoft", function () {
                    if (_.allowBlank && !e.trim(e(this).val()).length)e(this).val(null), Y.data("xdsoft_datetime").empty(); else if (Date.parseDate(e(this).val(), _.format))Y.data("xdsoft_datetime").setCurrentTime(e(this).val()); else {
                        var t = +[e(this).val()[0], e(this).val()[1]].join(""), a = +[e(this).val()[2], e(this).val()[3]].join("");
                        e(this).val(!_.datepicker && _.timepicker && t >= 0 && 24 > t && a >= 0 && 60 > a ? [t, a].map(function (e) {
                            return e > 9 ? e : "0" + e
                        }).join(":") : C.now().dateFormat(_.format)), Y.data("xdsoft_datetime").setCurrentTime(e(this).val())
                    }
                    Y.trigger("changedatetime.xdsoft")
                }), _.dayOfWeekStartPrev = 0 === _.dayOfWeekStart ? 6 : _.dayOfWeekStart - 1, Y.trigger("xchange.xdsoft").trigger("afterOpen.xdsoft")
            }, Y.data("options", _).on("mousedown.xdsoft", function (e) {
                return e.stopPropagation(), e.preventDefault(), V.hide(), B.hide(), !1
            }), N.append(L), N.xdsoftScroller(), Y.on("afterOpen.xdsoft", function () {
                N.xdsoftScroller()
            }), Y.append(J).append(I), _.withoutCopyright !== !0 && Y.append(j), J.append(z).append(H).append(E), e(_.parentID).append(Y), i = function () {
                var t = this;
                t.now = function (e) {
                    var a, n, r = new Date;
                    return !e && _.defaultDate && (a = t.strToDateTime(_.defaultDate), r.setFullYear(a.getFullYear()), r.setMonth(a.getMonth()), r.setDate(a.getDate())), _.yearOffset && r.setFullYear(r.getFullYear() + _.yearOffset), !e && _.defaultTime && (n = t.strtotime(_.defaultTime), r.setHours(n.getHours()), r.setMinutes(n.getMinutes())), r
                }, t.isValidDate = function (e) {
                    return "[object Date]" !== Object.prototype.toString.call(e) ? !1 : !isNaN(e.getTime())
                }, t.setCurrentTime = function (e) {
                    t.currentTime = "string" == typeof e ? t.strToDateTime(e) : t.isValidDate(e) ? e : t.now(), Y.trigger("xchange.xdsoft")
                }, t.empty = function () {
                    t.currentTime = null
                }, t.getCurrentTime = function () {
                    return t.currentTime
                }, t.nextMonth = function () {
                    (void 0 === t.currentTime || null === t.currentTime) && (t.currentTime = t.now());
                    var a, n = t.currentTime.getMonth() + 1;
                    return 12 === n && (t.currentTime.setFullYear(t.currentTime.getFullYear() + 1), n = 0), a = t.currentTime.getFullYear(), t.currentTime.setDate(Math.min(new Date(t.currentTime.getFullYear(), n + 1, 0).getDate(), t.currentTime.getDate())), t.currentTime.setMonth(n), _.onChangeMonth && e.isFunction(_.onChangeMonth) && _.onChangeMonth.call(Y, C.currentTime, Y.data("input")), a !== t.currentTime.getFullYear() && e.isFunction(_.onChangeYear) && _.onChangeYear.call(Y, C.currentTime, Y.data("input")), Y.trigger("xchange.xdsoft"), n
                }, t.prevMonth = function () {
                    (void 0 === t.currentTime || null === t.currentTime) && (t.currentTime = t.now());
                    var a = t.currentTime.getMonth() - 1;
                    return -1 === a && (t.currentTime.setFullYear(t.currentTime.getFullYear() - 1), a = 11), t.currentTime.setDate(Math.min(new Date(t.currentTime.getFullYear(), a + 1, 0).getDate(), t.currentTime.getDate())), t.currentTime.setMonth(a), _.onChangeMonth && e.isFunction(_.onChangeMonth) && _.onChangeMonth.call(Y, C.currentTime, Y.data("input")), Y.trigger("xchange.xdsoft"), a
                }, t.getWeekOfYear = function (e) {
                    var t = new Date(e.getFullYear(), 0, 1);
                    return Math.ceil(((e - t) / 864e5 + t.getDay() + 1) / 7)
                }, t.strToDateTime = function (e) {
                    var a, n, r = [];
                    return e && e instanceof Date && t.isValidDate(e) ? e : (r = /^(\+|\-)(.*)$/.exec(e), r && (r[2] = Date.parseDate(r[2], _.formatDate)), r && r[2] ? (a = r[2].getTime() - 6e4 * r[2].getTimezoneOffset(), n = new Date(t.now(!0).getTime() + parseInt(r[1] + "1", 10) * a)) : n = e ? Date.parseDate(e, _.format) : t.now(), t.isValidDate(n) || (n = t.now()), n)
                }, t.strToDate = function (e) {
                    if (e && e instanceof Date && t.isValidDate(e))return e;
                    var a = e ? Date.parseDate(e, _.formatDate) : t.now(!0);
                    return t.isValidDate(a) || (a = t.now(!0)), a
                }, t.strtotime = function (e) {
                    if (e && e instanceof Date && t.isValidDate(e))return e;
                    var a = e ? Date.parseDate(e, _.formatTime) : t.now(!0);
                    return t.isValidDate(a) || (a = t.now(!0)), a
                }, t.str = function () {
                    return t.currentTime.dateFormat(_.format)
                }, t.currentTime = this.now()
            }, C = new i, E.on("click", function (e) {
                e.preventDefault(), Y.data("changed", !0), C.setCurrentTime(o()), a.val(C.str()), Y.trigger("close.xdsoft")
            }), z.find(".xdsoft_today_button").on("mousedown.xdsoft", function () {
                Y.data("changed", !0), C.setCurrentTime(0), Y.trigger("afterOpen.xdsoft")
            }).on("dblclick.xdsoft", function () {
                var e, t, n = C.getCurrentTime();
                n = new Date(n.getFullYear(), n.getMonth(), n.getDate()), e = C.strToDate(_.minDate), e = new Date(e.getFullYear(), e.getMonth(), e.getDate()), e > n || (t = C.strToDate(_.maxDate), t = new Date(t.getFullYear(), t.getMonth(), t.getDate()), n > t || (a.val(C.str()), a.trigger("change"), Y.trigger("close.xdsoft")))
            }), z.find(".xdsoft_prev,.xdsoft_next").on("mousedown.xdsoft", function () {
                var t = e(this), a = 0, n = !1;
                !function r(e) {
                    t.hasClass(_.next) ? C.nextMonth() : t.hasClass(_.prev) && C.prevMonth(), _.monthChangeSpinner && (n || (a = setTimeout(r, e || 100)))
                }(500), e([document.body, window]).on("mouseup.xdsoft", function o() {
                    clearTimeout(a), n = !0, e([document.body, window]).off("mouseup.xdsoft", o)
                })
            }), I.find(".xdsoft_prev,.xdsoft_next").on("mousedown.xdsoft", function () {
                var t = e(this), a = 0, n = !1, r = 110;
                !function o(e) {
                    var i = N[0].clientHeight, s = L[0].offsetHeight, d = Math.abs(parseInt(L.css("marginTop"), 10));
                    t.hasClass(_.next) && s - i - _.timeHeightInTimePicker >= d ? L.css("marginTop", "-" + (d + _.timeHeightInTimePicker) + "px") : t.hasClass(_.prev) && d - _.timeHeightInTimePicker >= 0 && L.css("marginTop", "-" + (d - _.timeHeightInTimePicker) + "px"), N.trigger("scroll_element.xdsoft_scroller", [Math.abs(parseInt(L.css("marginTop"), 10) / (s - i))]), r = r > 10 ? 10 : r - 10, n || (a = setTimeout(o, e || r))
                }(500), e([document.body, window]).on("mouseup.xdsoft", function i() {
                    clearTimeout(a), n = !0, e([document.body, window]).off("mouseup.xdsoft", i)
                })
            }), W = 0, Y.on("xchange.xdsoft", function (t) {
                clearTimeout(W), W = setTimeout(function () {
                    (void 0 === C.currentTime || null === C.currentTime) && (C.currentTime = C.now());
                    for (var t, a, o, i, s, d, u, l, f, c, h = "", m = new Date(C.currentTime.getFullYear(), C.currentTime.getMonth(), 1, 12, 0, 0), g = 0, p = C.now(), y = !1, D = !1, v = [], b = !0, x = "", k = ""; m.getDay() !== _.dayOfWeekStart;)m.setDate(m.getDate() - 1);
                    for (h += "<table><thead><tr>", _.weeks && (h += "<th></th>"), t = 0; 7 > t; t += 1)h += "<th>" + _.i18n[r].dayOfWeekShort[(t + _.dayOfWeekStart) % 7] + "</th>";

                    for (h += "</tr></thead>", h += "<tbody>", _.maxDate !== !1 && (y = C.strToDate(_.maxDate), y = new Date(y.getFullYear(), y.getMonth(), y.getDate(), 23, 59, 59, 999)), _.minDate !== !1 && (D = C.strToDate(_.minDate), D = new Date(D.getFullYear(), D.getMonth(), D.getDate())); g < C.currentTime.countDaysInMonth() || m.getDay() !== _.dayOfWeekStart || C.currentTime.getMonth() === m.getMonth();)v = [], g += 1, o = m.getDay(), i = m.getDate(), s = m.getFullYear(), d = m.getMonth(), u = C.getWeekOfYear(m), c = "", v.push("xdsoft_date"), l = _.beforeShowDay && e.isFunction(_.beforeShowDay.call) ? _.beforeShowDay.call(Y, m) : null, y !== !1 && m > y || D !== !1 && D > m || l && l[0] === !1 ? v.push("xdsoft_disabled") : -1 !== _.disabledDates.indexOf(m.dateFormat(_.formatDate)) ? v.push("xdsoft_disabled") : -1 !== _.disabledWeekDays.indexOf(o) && v.push("xdsoft_disabled"), l && "" !== l[1] && v.push(l[1]), C.currentTime.getMonth() !== d && v.push("xdsoft_other_month"), (_.defaultSelect || Y.data("changed")) && C.currentTime.dateFormat(_.formatDate) === m.dateFormat(_.formatDate) && v.push("xdsoft_current"), p.dateFormat(_.formatDate) === m.dateFormat(_.formatDate) && v.push("xdsoft_today"), (0 === m.getDay() || 6 === m.getDay() || -1 !== _.weekends.indexOf(m.dateFormat(_.formatDate))) && v.push("xdsoft_weekend"), void 0 !== _.highlightedDates[m.dateFormat(_.formatDate)] && (a = _.highlightedDates[m.dateFormat(_.formatDate)], v.push(void 0 === a.style ? "xdsoft_highlighted_default" : a.style), c = void 0 === a.desc ? "" : a.desc), _.beforeShowDay && e.isFunction(_.beforeShowDay) && v.push(_.beforeShowDay(m)), b && (h += "<tr>", b = !1, _.weeks && (h += "<th>" + u + "</th>")), h += '<td data-date="' + i + '" data-month="' + d + '" data-year="' + s + '" class="xdsoft_date xdsoft_day_of_week' + m.getDay() + " " + v.join(" ") + '" title="' + c + '"><div>' + i + "</div></td>", m.getDay() === _.dayOfWeekStartPrev && (h += "</tr>", b = !0), m.setDate(i + 1);
                    if (h += "</tbody></table>", H.html(h), z.find(".xdsoft_label span").eq(0).text(_.i18n[r].months[C.currentTime.getMonth()]), z.find(".xdsoft_label span").eq(1).text(C.currentTime.getFullYear()), x = "", k = "", d = "", f = function (t, a) {
                            var n, r, o = C.now(), i = _.allowTimes && e.isArray(_.allowTimes) && _.allowTimes.length;
                            o.setHours(t), t = parseInt(o.getHours(), 10), o.setMinutes(a), a = parseInt(o.getMinutes(), 10), n = new Date(C.currentTime), n.setHours(t), n.setMinutes(a), v = [], (_.minDateTime !== !1 && _.minDateTime > n || _.maxTime !== !1 && C.strtotime(_.maxTime).getTime() < o.getTime() || _.minTime !== !1 && C.strtotime(_.minTime).getTime() > o.getTime()) && v.push("xdsoft_disabled"), (_.minDateTime !== !1 && _.minDateTime > n || _.disabledMinTime !== !1 && o.getTime() > C.strtotime(_.disabledMinTime).getTime() && _.disabledMaxTime !== !1 && o.getTime() < C.strtotime(_.disabledMaxTime).getTime()) && v.push("xdsoft_disabled"), r = new Date(C.currentTime), r.setHours(parseInt(C.currentTime.getHours(), 10)), i || r.setMinutes(Math[_.roundTime](C.currentTime.getMinutes() / _.step) * _.step), (_.initTime || _.defaultSelect || Y.data("changed")) && r.getHours() === parseInt(t, 10) && (!i && _.step > 59 || r.getMinutes() === parseInt(a, 10)) && (_.defaultSelect || Y.data("changed") ? v.push("xdsoft_current") : _.initTime && v.push("xdsoft_init_time")), parseInt(p.getHours(), 10) === parseInt(t, 10) && parseInt(p.getMinutes(), 10) === parseInt(a, 10) && v.push("xdsoft_today"), x += '<div class="xdsoft_time ' + v.join(" ") + '" data-hour="' + t + '" data-minute="' + a + '">' + o.dateFormat(_.formatTime) + "</div>"
                        }, _.allowTimes && e.isArray(_.allowTimes) && _.allowTimes.length)for (g = 0; g < _.allowTimes.length; g += 1)k = C.strtotime(_.allowTimes[g]).getHours(), d = C.strtotime(_.allowTimes[g]).getMinutes(), f(k, d); else for (g = 0, t = 0; g < (_.hours12 ? 12 : 24); g += 1)for (t = 0; 60 > t; t += _.step)k = (10 > g ? "0" : "") + g, d = (10 > t ? "0" : "") + t, f(k, d);
                    for (L.html(x), n = "", g = 0, g = parseInt(_.yearStart, 10) + _.yearOffset; g <= parseInt(_.yearEnd, 10) + _.yearOffset; g += 1)n += '<div class="xdsoft_option ' + (C.currentTime.getFullYear() === g ? "xdsoft_current" : "") + '" data-value="' + g + '">' + g + "</div>";
                    for (V.children().eq(0).html(n), g = parseInt(_.monthStart, 10), n = ""; g <= parseInt(_.monthEnd, 10); g += 1)n += '<div class="xdsoft_option ' + (C.currentTime.getMonth() === g ? "xdsoft_current" : "") + '" data-value="' + g + '">' + _.i18n[r].months[g] + "</div>";
                    B.children().eq(0).html(n), e(Y).trigger("generate.xdsoft")
                }, 10), t.stopPropagation()
            }).on("afterOpen.xdsoft", function () {
                if (_.timepicker) {
                    var e, t, a, n;
                    L.find(".xdsoft_current").length ? e = ".xdsoft_current" : L.find(".xdsoft_init_time").length && (e = ".xdsoft_init_time"), e ? (t = N[0].clientHeight, a = L[0].offsetHeight, n = L.find(e).index() * _.timeHeightInTimePicker + 1, n > a - t && (n = a - t), N.trigger("scroll_element.xdsoft_scroller", [parseInt(n, 10) / (a - t)])) : N.trigger("scroll_element.xdsoft_scroller", [0])
                }
            }), F = 0, H.on("click.xdsoft", "td", function (t) {
                t.stopPropagation(), F += 1;
                var n = e(this), r = C.currentTime;
                return (void 0 === r || null === r) && (C.currentTime = C.now(), r = C.currentTime), n.hasClass("xdsoft_disabled") ? !1 : (r.setDate(1), r.setFullYear(n.data("year")), r.setMonth(n.data("month")), r.setDate(n.data("date")), Y.trigger("select.xdsoft", [r]), a.val(C.str()), _.onSelectDate && e.isFunction(_.onSelectDate) && _.onSelectDate.call(Y, C.currentTime, Y.data("input"), t), Y.data("changed", !0), Y.trigger("xchange.xdsoft"), Y.trigger("changedatetime.xdsoft"), (F > 1 || _.closeOnDateSelect === !0 || _.closeOnDateSelect === !1 && !_.timepicker) && !_.inline && Y.trigger("close.xdsoft"), void setTimeout(function () {
                    F = 0
                }, 200))
            }), L.on("click.xdsoft", "div", function (t) {
                t.stopPropagation();
                var a = e(this), n = C.currentTime;
                return (void 0 === n || null === n) && (C.currentTime = C.now(), n = C.currentTime), a.hasClass("xdsoft_disabled") ? !1 : (n.setHours(a.data("hour")), n.setMinutes(a.data("minute")), Y.trigger("select.xdsoft", [n]), Y.data("input").val(C.str()), _.onSelectTime && e.isFunction(_.onSelectTime) && _.onSelectTime.call(Y, C.currentTime, Y.data("input"), t), Y.data("changed", !0), Y.trigger("xchange.xdsoft"), Y.trigger("changedatetime.xdsoft"), void(_.inline !== !0 && _.closeOnTimeSelect === !0 && Y.trigger("close.xdsoft")))
            }), J.on("mousewheel.xdsoft", function (e) {
                return _.scrollMonth ? (e.deltaY < 0 ? C.nextMonth() : C.prevMonth(), !1) : !0
            }), a.on("mousewheel.xdsoft", function (e) {
                return _.scrollInput ? !_.datepicker && _.timepicker ? (A = L.find(".xdsoft_current").length ? L.find(".xdsoft_current").eq(0).index() : 0, A + e.deltaY >= 0 && A + e.deltaY < L.children().length && (A += e.deltaY), L.children().eq(A).length && L.children().eq(A).trigger("mousedown"), !1) : _.datepicker && !_.timepicker ? (J.trigger(e, [e.deltaY, e.deltaX, e.deltaY]), a.val && a.val(C.str()), Y.trigger("changedatetime.xdsoft"), !1) : void 0 : !0
            }), Y.on("changedatetime.xdsoft", function (t) {
                if (_.onChangeDateTime && e.isFunction(_.onChangeDateTime)) {
                    var a = Y.data("input");
                    _.onChangeDateTime.call(Y, C.currentTime, a, t), delete _.value, a.trigger("change")
                }
            }).on("generate.xdsoft", function () {
                _.onGenerate && e.isFunction(_.onGenerate) && _.onGenerate.call(Y, C.currentTime, Y.data("input")), R && (Y.trigger("afterOpen.xdsoft"), R = !1)
            }).on("click.xdsoft", function (e) {
                e.stopPropagation()
            }), A = 0, P = function () {
                var t, a = Y.data("input").offset(), n = a.top + Y.data("input")[0].offsetHeight - 1, r = a.left, o = "absolute";
                "rtl" == Y.data("input").parent().css("direction") && (r -= Y.outerWidth() - Y.data("input").outerWidth()), _.fixed ? (n -= e(window).scrollTop(), r -= e(window).scrollLeft(), o = "fixed") : (n + Y[0].offsetHeight > e(window).height() + e(window).scrollTop() && (n = a.top - Y[0].offsetHeight + 1), 0 > n && (n = 0), r + Y[0].offsetWidth > e(window).width() && (r = e(window).width() - Y[0].offsetWidth)), t = Y[0];
                do if (t = t.parentNode, "relative" === window.getComputedStyle(t).getPropertyValue("position") && e(window).width() >= t.offsetWidth) {
                    r -= (e(window).width() - t.offsetWidth) / 2;
                    break
                } while ("HTML" !== t.nodeName);
                Y.css({left: r, top: n, position: o})
            }, Y.on("open.xdsoft", function (t) {
                var a = !0;
                _.onShow && e.isFunction(_.onShow) && (a = _.onShow.call(Y, C.currentTime, Y.data("input"), t)), a !== !1 && (Y.show(), P(), e(window).off("resize.xdsoft", P).on("resize.xdsoft", P), _.closeOnWithoutClick && e([document.body, window]).on("mousedown.xdsoft", function n() {
                    Y.trigger("close.xdsoft"), e([document.body, window]).off("mousedown.xdsoft", n)
                }))
            }).on("close.xdsoft", function (t) {
                var a = !0;
                z.find(".xdsoft_month,.xdsoft_year").find(".xdsoft_select").hide(), _.onClose && e.isFunction(_.onClose) && (a = _.onClose.call(Y, C.currentTime, Y.data("input"), t)), a === !1 || _.opened || _.inline || Y.hide(), t.stopPropagation()
            }).on("toggle.xdsoft", function () {
                Y.trigger(Y.is(":visible") ? "close.xdsoft" : "open.xdsoft")
            }).data("input", a), q = 0, G = 0, Y.data("xdsoft_datetime", C), Y.setOptions(_), C.setCurrentTime(o()), a.data("xdsoft_datetimepicker", Y).on("open.xdsoft focusin.xdsoft mousedown.xdsoft", function () {
                a.is(":disabled") || a.data("xdsoft_datetimepicker").is(":visible") && _.closeOnInputClick || (clearTimeout(q), q = setTimeout(function () {
                    a.is(":disabled") || (R = !0, C.setCurrentTime(o()), Y.trigger("open.xdsoft"))
                }, 100))
            }).on("keydown.xdsoft", function (t) {
                var a, n = (this.value, t.which);
                return -1 !== [h].indexOf(n) && _.enterLikeTab ? (a = e("input:visible,textarea:visible"), Y.trigger("close.xdsoft"), a.eq(a.index(this) + 1).focus(), !1) : -1 !== [b].indexOf(n) ? (Y.trigger("close.xdsoft"), !0) : void 0
            })
        }, i = function (t) {
            var a = t.data("xdsoft_datetimepicker");
            a && (a.data("xdsoft_datetime", null), a.remove(), t.data("xdsoft_datetimepicker", null).off(".xdsoft"), e(window).off("resize.xdsoft"), e([window, document.body]).off("mousedown.xdsoft"), t.unmousewheel && t.unmousewheel())
        }, e(document).off("keydown.xdsoftctrl keyup.xdsoftctrl").on("keydown.xdsoftctrl", function (e) {
            e.keyCode === f && (w = !0)
        }).on("keyup.xdsoftctrl", function (e) {
            e.keyCode === f && (w = !1)
        }), this.each(function () {
            var t, a = e(this).data("xdsoft_datetimepicker");
            if (a) {
                if ("string" === e.type(n))switch (n) {
                    case"show":
                        e(this).select().focus(), a.trigger("open.xdsoft");
                        break;
                    case"hide":
                        a.trigger("close.xdsoft");
                        break;
                    case"toggle":
                        a.trigger("toggle.xdsoft");
                        break;
                    case"destroy":
                        i(e(this));
                        break;
                    case"reset":
                        this.value = this.defaultValue, this.value && a.data("xdsoft_datetime").isValidDate(Date.parseDate(this.value, _.format)) || a.data("changed", !1), a.data("xdsoft_datetime").setCurrentTime(this.value);
                        break;
                    case"validate":
                        t = a.data("input"), t.trigger("blur.xdsoft")
                } else a.setOptions(n);
                return 0
            }
            "string" !== e.type(n) && (!_.lazyInit || _.open || _.inline ? o(e(this)) : F(e(this)))
        })
    }, e.fn.datetimepicker.defaults = a
}), function (e) {
    "function" == typeof define && define.amd ? define(["jquery"], e) : "object" == typeof exports ? module.exports = e : e(jQuery)
}(function (e) {
    function t(t) {
        var i = t || window.event, s = d.call(arguments, 1), u = 0, f = 0, c = 0, h = 0, m = 0, g = 0;
        if (t = e.event.fix(i), t.type = "mousewheel", "detail" in i && (c = -1 * i.detail), "wheelDelta" in i && (c = i.wheelDelta), "wheelDeltaY" in i && (c = i.wheelDeltaY), "wheelDeltaX" in i && (f = -1 * i.wheelDeltaX), "axis" in i && i.axis === i.HORIZONTAL_AXIS && (f = -1 * c, c = 0), u = 0 === c ? f : c, "deltaY" in i && (c = -1 * i.deltaY, u = c), "deltaX" in i && (f = i.deltaX, 0 === c && (u = -1 * f)), 0 !== c || 0 !== f) {
            if (1 === i.deltaMode) {
                var p = e.data(this, "mousewheel-line-height");
                u *= p, c *= p, f *= p
            } else if (2 === i.deltaMode) {
                var y = e.data(this, "mousewheel-page-height");
                u *= y, c *= y, f *= y
            }
            if (h = Math.max(Math.abs(c), Math.abs(f)), (!o || o > h) && (o = h, n(i, h) && (o /= 40)), n(i, h) && (u /= 40, f /= 40, c /= 40), u = Math[u >= 1 ? "floor" : "ceil"](u / o), f = Math[f >= 1 ? "floor" : "ceil"](f / o), c = Math[c >= 1 ? "floor" : "ceil"](c / o), l.settings.normalizeOffset && this.getBoundingClientRect) {
                var D = this.getBoundingClientRect();
                m = t.clientX - D.left, g = t.clientY - D.top
            }
            return t.deltaX = f, t.deltaY = c, t.deltaFactor = o, t.offsetX = m, t.offsetY = g, t.deltaMode = 0, s.unshift(t, u, f, c), r && clearTimeout(r), r = setTimeout(a, 200), (e.event.dispatch || e.event.handle).apply(this, s)
        }
    }

    function a() {
        o = null
    }

    function n(e, t) {
        return l.settings.adjustOldDeltas && "mousewheel" === e.type && t % 120 === 0
    }

    var r, o, i = ["wheel", "mousewheel", "DOMMouseScroll", "MozMousePixelScroll"], s = "onwheel" in document || document.documentMode >= 9 ? ["wheel"] : ["mousewheel", "DomMouseScroll", "MozMousePixelScroll"], d = Array.prototype.slice;
    if (e.event.fixHooks)for (var u = i.length; u;)e.event.fixHooks[i[--u]] = e.event.mouseHooks;
    var l = e.event.special.mousewheel = {
        version: "3.1.12", setup: function () {
            if (this.addEventListener)for (var a = s.length; a;)this.addEventListener(s[--a], t, !1); else this.onmousewheel = t;
            e.data(this, "mousewheel-line-height", l.getLineHeight(this)), e.data(this, "mousewheel-page-height", l.getPageHeight(this))
        }, teardown: function () {
            if (this.removeEventListener)for (var a = s.length; a;)this.removeEventListener(s[--a], t, !1); else this.onmousewheel = null;
            e.removeData(this, "mousewheel-line-height"), e.removeData(this, "mousewheel-page-height")
        }, getLineHeight: function (t) {
            var a = e(t), n = a["offsetParent" in e.fn ? "offsetParent" : "parent"]();
            return n.length || (n = e("body")), parseInt(n.css("fontSize"), 10) || parseInt(a.css("fontSize"), 10) || 16
        }, getPageHeight: function (t) {
            return e(t).height()
        }, settings: {adjustOldDeltas: !0, normalizeOffset: !0}
    };
    e.fn.extend({
        mousewheel: function (e) {
            return e ? this.bind("mousewheel", e) : this.trigger("mousewheel")
        }, unmousewheel: function (e) {
            return this.unbind("mousewheel", e)
        }
    })
}), !function (e) {
    "function" == typeof define && define.amd ? define([], e) : "object" == typeof exports ? module.exports = e : e()
}(function () {
    "use strict";
    function e(e) {
        for (var a = [], n = !1, r = "", i = 0; i < e.length; ++i)r = e.charAt(i), n || "\\" !== r ? n ? (n = !1, a.push(o(r))) : a.push(l[r] || o(r)) : n = !0;
        u[e] = t(a)
    }

    function t(e) {
        return function (t) {
            for (var a = [], n = 0, r = e.length; r > n; n++)a.push("string" == typeof e[n] ? e[n] : e[n](t));
            return a.join("")
        }
    }

    function a(e, t, a) {
        return function (e) {
            var n = new Date, r = e.match(d[t]);
            if (r && r.length > 0) {
                r.y = n.getFullYear(), r.m = n.getMonth(), r.d = n.getDate(), r.h = -1, r.i = -1, r.s = -1;
                for (var o = 0, i = a.length; i > o; o++)a[o](r);
                if (r.y > 0 && r.m >= 0 && r.d > 0 && r.h >= 0 && r.i >= 0 && r.s >= 0)return new Date(r.y, r.m, r.d, r.h, r.i, r.s);
                if (r.y > 0 && r.m >= 0 && r.d > 0 && r.h >= 0 && r.i >= 0)return new Date(r.y, r.m, r.d, r.h, r.i);
                if (r.y > 0 && r.m >= 0 && r.d > 0 && r.h >= 0)return new Date(r.y, r.m, r.d, r.h);
                if (r.y > 0 && r.m >= 0 && r.d > 0)return new Date(r.y, r.m, r.d);
                if (r.y > 0 && r.m >= 0)return new Date(r.y, r.m);
                if (r.y > 0)return new Date(r.y)
            }
            return null
        }
    }

    function n(e) {
        for (var t, n = d.length, i = 1, u = "", l = !1, f = "", c = [], h = 0; h < e.length; ++h)f = e.charAt(h), l || "\\" !== f ? l ? (l = !1, u += o(f)) : (t = r(f, i), i += t.g, u += t.s, t.g && t.a && c.push(t.a)) : l = !0;
        d[n] = new RegExp("^" + u + "$"), s[e] = a(e, n, c)
    }

    function r(e, t) {
        switch (e) {
            case"D":
                return {g: 0, s: "(?:Sun|Mon|Tue|Wed|Thu|Fri|Sat)"};
            case"j":
            case"d":
                return {
                    g: 1, a: function (e) {
                        e.d = parseInt(e[t], 10)
                    }, s: "(\\d{1,2})"
                };
            case"l":
                return {g: 0, s: "(?:" + Date.dayNames.join("|") + ")"};
            case"S":
                return {g: 0, s: "(?:st|nd|rd|th)"};
            case"w":
                return {g: 0, s: "\\d"};
            case"z":
                return {g: 0, s: "(?:\\d{1,3})"};
            case"W":
                return {g: 0, s: "(?:\\d{2})"};
            case"F":
                return {
                    g: 1, a: function (e) {
                        e.m = parseInt(Date.monthNumbers[e[t].substring(0, 3)], 10)
                    }, s: "(" + Date.monthNames.join("|") + ")"
                };
            case"M":
                return {
                    g: 1, a: function (e) {
                        e.m = parseInt(Date.monthNumbers[e[t]], 10)
                    }, s: "(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)"
                };
            case"n":
            case"m":
                return {
                    g: 1, a: function (e) {
                        e.m = parseInt(e[t], 10) - 1
                    }, s: "(\\d{1,2})"
                };
            case"t":
                return {g: 0, s: "\\d{1,2}"};
            case"L":
                return {g: 0, s: "(?:1|0)"};
            case"Y":
                return {
                    g: 1, a: function (e) {
                        e.y = parseInt(e[t], 10)
                    }, s: "(\\d{4})"
                };
            case"y":
                return {
                    g: 1, a: function (e) {
                        var a = parseInt(e[t], 10);
                        e.y = a > Date.y2kYear ? 1900 + a : 2e3 + a
                    }, s: "(\\d{1,2})"
                };
            case"a":
                return {
                    g: 1, a: function (e) {
                        "am" === e[t] ? 12 == e.h && (e.h = 0) : e.h < 12 && (e.h += 12)
                    }, s: "(am|pm)"
                };
            case"A":
                return {
                    g: 1, a: function (e) {
                        "AM" === e[t] ? 12 == e.h && (e.h = 0) : e.h < 12 && (e.h += 12)
                    }, s: "(AM|PM)"
                };
            case"g":
            case"G":
            case"h":
            case"H":
                return {
                    g: 1, a: function (e) {
                        e.h = parseInt(e[t], 10)
                    }, s: "(\\d{1,2})"
                };
            case"i":
                return {
                    g: 1, a: function (e) {
                        e.i = parseInt(e[t], 10)
                    }, s: "(\\d{2})"
                };
            case"s":
                return {
                    g: 1, a: function (e) {
                        e.s = parseInt(e[t], 10)
                    }, s: "(\\d{2})"
                };
            case"O":
                return {g: 0, s: "[+-]\\d{4}"};
            case"T":
                return {g: 0, s: "[A-Z]{3}"};
            case"Z":
                return {g: 0, s: "[+-]\\d{1,5}"};
            default:
                return {g: 0, s: o(e)}
        }
    }

    function o(e) {
        return e.replace(/('|\\)/g, "\\$1")
    }

    function i(e, t, a) {
        var n = "" + e;
        for (a = "" + a || " "; n.length < t;)n = a + n;
        return n
    }

    var s = {}, d = [], u = {}, l = {
        d: function (e) {
            return i(e.getDate(), 2, "0")
        }, D: function (e) {
            return Date.dayNames[e.getDay()].substring(0, 3)
        }, j: function (e) {
            return e.getDate()
        }, l: function (e) {
            return Date.dayNames[e.getDay()]
        }, S: function (e) {
            return e.getSuffix()
        }, w: function (e) {
            return e.getDay()
        }, z: function (e) {
            return e.getDayOfYear()
        }, W: function (e) {
            return e.getWeekOfYear()
        }, F: function (e) {
            return Date.monthNames[e.getMonth()]
        }, m: function (e) {
            return i(e.getMonth() + 1, 2, "0")
        }, M: function (e) {
            return Date.monthNames[e.getMonth()].substring(0, 3)
        }, n: function (e) {
            return e.getMonth() + 1
        }, t: function (e) {
            return e.getDaysInMonth()
        }, L: function (e) {
            return e.isLeapYear() ? 1 : 0
        }, Y: function (e) {
            return e.getFullYear()
        }, y: function (e) {
            return ("" + e.getFullYear()).substring(2, 4)
        }, a: function (e) {
            return e.getHours() < 12 ? "am" : "pm"
        }, A: function (e) {
            return e.getHours() < 12 ? "AM" : "PM"
        }, g: function (e) {
            return e.getHours() % 12 ? e.getHours() % 12 : 12
        }, G: function (e) {
            return e.getHours()
        }, h: function (e) {
            return i(e.getHours() % 12 ? e.getHours() % 12 : 12, 2, "0")
        }, H: function (e) {
            return i(e.getHours(), 2, "0")
        }, i: function (e) {
            return i(e.getMinutes(), 2, "0")
        }, s: function (e) {
            return i(e.getSeconds(), 2, "0")
        }, O: function (e) {
            return e.getGMTOffset()
        }, T: function (e) {
            return e.getTimezone()
        }, Z: function (e) {
            return -60 * e.getTimezoneOffset()
        }
    };
    Date.prototype.dateFormat = function (t) {
        return u[t] || e(t), u[t](this)
    }, Date.parseDate = function (e, t) {
        return s[t] || n(t), s[t](e)
    }, Date.prototype.getTimezone = function () {
        return this.toString().replace(/^.*? ([A-Z]{3}) [0-9]{4}.*$/, "$1").replace(/^.*?\(([A-Z])[a-z]+ ([A-Z])[a-z]+ ([A-Z])[a-z]+\)$/, "$1$2$3")
    }, Date.prototype.getGMTOffset = function () {
        return (this.getTimezoneOffset() > 0 ? "-" : "+") + i(Math.floor(this.getTimezoneOffset() / 60), 2, "0") + i(this.getTimezoneOffset() % 60, 2, "0")
    }, Date.prototype.getDayOfYear = function () {
        var e = 0;
        Date.daysInMonth[1] = this.isLeapYear() ? 29 : 28;
        for (var t = 0; t < this.getMonth(); ++t)e += Date.daysInMonth[t];
        return e + this.getDate() - 1
    }, Date.prototype.getWeekOfYear = function () {
        var e = this.getDayOfYear() + (4 - this.getDay()), t = new Date(this.getFullYear(), 0, 1), a = 7 - t.getDay() + 4;
        return i((e - a) / 7 + 1, 2, "0")
    }, Date.prototype.isLeapYear = function () {
        var e = this.getFullYear();
        return !(0 !== (3 & e) || !(e % 100 || e % 400 === 0 && e))
    }, Date.prototype.getFirstDayOfMonth = function () {
        var e = (this.getDay() - (this.getDate() - 1)) % 7;
        return 0 > e ? e + 7 : e
    }, Date.prototype.getLastDayOfMonth = function () {
        var e = (this.getDay() + (Date.daysInMonth[this.getMonth()] - this.getDate())) % 7;
        return 0 > e ? e + 7 : e
    }, Date.prototype.getDaysInMonth = function () {
        return Date.daysInMonth[1] = this.isLeapYear() ? 29 : 28, Date.daysInMonth[this.getMonth()]
    }, Date.prototype.getSuffix = function () {
        switch (this.getDate()) {
            case 1:
            case 21:
            case 31:
                return "st";
            case 2:
            case 22:
                return "nd";
            case 3:
            case 23:
                return "rd";
            default:
                return "th"
        }
    }, Date.daysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31], Date.monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"], Date.dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"], Date.y2kYear = 50, Date.monthNumbers = {
        Jan: 0,
        Feb: 1,
        Mar: 2,
        Apr: 3,
        May: 4,
        Jun: 5,
        Jul: 6,
        Aug: 7,
        Sep: 8,
        Oct: 9,
        Nov: 10,
        Dec: 11
    }, Date.patterns = {
        ISO8601LongPattern: "Y-m-d H:i:s",
        ISO8601ShortPattern: "Y-m-d",
        ShortDatePattern: "n/j/Y",
        LongDatePattern: "l, F d, Y",
        FullDateTimePattern: "l, F d, Y g:i:s A",
        MonthDayPattern: "F d",
        ShortTimePattern: "g:i A",
        LongTimePattern: "g:i:s A",
        SortableDateTimePattern: "Y-m-d\\TH:i:s",
        UniversalSortableDateTimePattern: "Y-m-d H:i:sO",
        YearMonthPattern: "F, Y"
    }
});