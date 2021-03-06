<?php

use Illuminate\Support\Facades\Lang;

return [
    'CHART_COLORS' => [
        "#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0", "#B2912F", "#DECF3F", "#B276B2", "#60BD68"
    ],
    /* 1-5 */
    'WEIGHT_HISTORY' => 1,
    'WEIGHT_DAY_AVAILABILITY' => 1,
    'WEIGHT_QUANTITY' => 1,
    'WEIGHT_CHILDREN' => 1,
    'SHORT_MONTH' => [
        'sv' =>
            [
                1 => 'jan',
                2 => 'feb',
                3 => 'mar',
                4 => 'apr',
                5 => 'maj',
                6 => 'jun',
                7 => 'jul',
                8 => 'aug',
                9 => 'sep',
                10 => 'okt',
                11 => 'nov',
                12 => 'dec',
            ],
        'en' =>
            [
                1 => 'jan',
                2 => 'feb',
                3 => 'mar',
                4 => 'apr',
                5 => 'maj',
                6 => 'jun',
                7 => 'jul',
                8 => 'aug',
                9 => 'sep',
                10 => 'okt',
                11 => 'nov',
                12 => 'dec',
            ],
    ],
    'MONTH' => [
        'sv' =>
            [
                1 => 'januari',
                2 => 'februari',
                3 => 'mars',
                4 => 'april',
                5 => 'maj',
                6 => 'juni',
                7 => 'juli',
                8 => 'augusti',
                9 => 'september',
                10 => 'oktober',
                11 => 'november',
                12 => 'december',
            ],
        'en' =>
            [
                1 => 'january',
                2 => 'february',
                3 => 'march',
                4 => 'april',
                5 => 'may',
                6 => 'june',
                7 => 'july',
                8 => 'august',
                9 => 'september',
                10 => 'october',
                11 => 'november',
                12 => 'december',
            ],
    ],
    'DINNER_STATUSES' => [
        'sv' =>
            [
                1 => 'Aktiv',
                2 => 'Med match',
                3 => 'Inst??lld',
                4 => 'V??rd meddelad om match'
            ],
        'en' =>
            [
                1 => 'Active',
                2 => 'With match',
                3 => 'Cancelled',
                4 => 'Host informed of match'
            ]
    ],
    'MATCH_STATUSES' => [
        'sv' =>
            [
                1 => 'F??reslagen',
                2 => 'Godk??nd',
                3 => 'Nekad'
            ],
        'en' =>
            [
                1 => 'Suggested',
                2 => 'Approved',
                3 => 'Denied'
            ]
    ],
    'MATCH_STATUS_CLASSES' => [
            1 => 'label-info',
            2 => 'label-success',
            3 => 'label-warning'
    ],

    'GENDERS' => [
        'sv' => [
            'F' => 'Kvinna',
            'M' => 'Man',
            'A' => 'Annat',
            ],
        'en' => [
            'F' => 'Female',
            'M' => 'Male',
            'O' => 'Other',
        ]
    ],
    'LANGUAGE_PROFICIENCIES' => [
        'sv' => [
            '1' => 'Talar flytande',
            '0' => 'Vill bli b??ttre'
        ],
        'en' => [
            '1' => 'Speaks fluently',
            '0' => 'Wants to get better',
        ]
    ],
    'AGE' => [
        'sv' => [
            '1' => '18-24',
            '2' => '25-30',
            '3' => '31-40',
            '4' => '41-50',
            '5' => '51-60',
            '6' => '60+',
            '0' => 'Vill inte ange',
        ],
        'en' => [
            '1' => '18-24',
            '2' => '25-30',
            '3' => '31-40',
            '4' => '41-50',
            '5' => '51-60',
            '6' => '60+',
            '0' => 'Private',
        ]
    ],
    'HOURS_DISABLED' => [1,2,3],
    'DINNER_GUEST_CAPACITY' => [
        'sv' => [
            '3' => 'Spelar ingen roll',
            '2' => 'G??rna en familj',
            '1' => 'En g??st + eventuell s??llskap',
            
        ],
        'en' => [
            '2' => 'I prefer a family',
            '1' => 'Max two people',
            '3' => 'No preference',
        ],
    ],
    'PREFERENCE_TYPES' => [
        'en' => [
            'food' => 'Food',
            'allergy' => 'Allergi'
        ],
        'sv' => [
            'food' => 'Mat',
            'allergy' => 'Allergi'
        ]
    ],
    'MAX_MATCHES_PER_DINNER' => 20,
    'WEEKDAYS' => [
        'sv' => [
            '-1' => 'Alla dagar',
            '1' => 'm??ndag',
            '2' => 'tisdag',
            '3' => 'onsdag',
            '4' => 'torsdag',
            '5' => 'fredag',
            '6' => 'l??rdag',
            '0' => 's??ndag',
        ],
        'en' => [
            '-1' => 'Any day',
            '1' => 'Monday',
            '2' => 'Tuesday',
            '3' => 'Wednesday',
            '4' => 'Thursday',
            '5' => 'Friday',
            '6' => 'Saturday',
            '0' => 'Sunday',
        ],
    ],
    'NATIONALITIES' => [
        'Sverige' => 'Sverige',
        'Abchazien' => 'Abchazien',
        'Afghanistan' => 'Afghanistan',
        'Albanien ' => 'Albanien',
        'Algeriet ' => 'Algeriet',
        'Amerikanska Jungfru??arna ' => 'Amerikanska Jungfru??arna',
        'Amerikanska Samoa' => 'Amerikanska Samoa',
        'Andorra' => 'Andorra',
        'Angola' => 'Angola',
        'Anguilla ' => 'Anguilla',
        'Antarktis' => 'Antarktis',
        'Antigua och Barbuda' => 'Antigua och Barbuda',
        'Argentina' => 'Argentina',
        'Armenien ' => 'Armenien',
        'Aruba' => 'Aruba',
        'Australien ' => 'Australien',
        'Azerbajdzjan' => 'Azerbajdzjan',
        'Bahamas' => 'Bahamas',
        'Bahrain' => 'Bahrain',
        'Bangladesh ' => 'Bangladesh',
        'Barbados ' => 'Barbados',
        'Belgien' => 'Belgien',
        'Belize' => 'Belize',
        'Benin' => 'Benin',
        'Bermuda' => 'Bermuda',
        'Bhutan' => 'Bhutan',
        'Bolivia' => 'Bolivia',
        'Bosnien och Hercegovina' => 'Bosnien och Hercegovina',
        'Botswana ' => 'Botswana',
        'Bouvet??n ' => 'Bouvet??n',
        'Brasilien' => 'Brasilien',
        'Brittiska Jungfru??arna' => 'Brittiska Jungfru??arna',
        'Brittiska territoriet i Indisk' => 'Brittiska territoriet i Indisk',
        'Brunei' => 'Brunei',
        'Bulgarien' => 'Bulgarien',
        'Burkina Faso' => 'Burkina Faso',
        'Burma' => 'Burma',
        'Burundi' => 'Burundi',
        'Cayman??arna' => 'Cayman??arna',
        'Centralafrikanska republiken' => 'Centralafrikanska republiken',
        'Chile' => 'Chile',
        'Colombia ' => 'Colombia',
        'Cook??arna' => 'Cook??arna',
        'Costa Rica ' => 'Costa Rica',
        'Cura??ao' => 'Cura??ao',
        'Cypern' => 'Cypern',
        'Danmark' => 'Danmark',
        'Djibouti ' => 'Djibouti',
        'Dominica ' => 'Dominica',
        'Dominikanska republiken' => 'Dominikanska republiken',
        'Ecuador' => 'Ecuador',
        'Egypten' => 'Egypten',
        'Ekvatorialguinea ' => 'Ekvatorialguinea',
        'El Salvador' => 'El Salvador',
        'Elfenbenskusten' => 'Elfenbenskusten',
        'Eritrea' => 'Eritrea',
        'Estland' => 'Estland',
        'Etiopien ' => 'Etiopien',
        'Falklands??arna' => 'Falklands??arna',
        'Fiji' => 'Fiji',
        'Filippinerna' => 'Filippinerna',
        'Finland' => 'Finland',
        'Frankrike' => 'Frankrike',
        'Franska Guyana' => 'Franska Guyana',
        'Franska Polynesien ' => 'Franska Polynesien',
        'Franska syd- och Antarktisterritorier' => 'Franska syd- och Antarktisterritorier ',
        'F??r??arna ' => 'F??r??arna',
        'F??renade Arabemiraten' => 'F??renade Arabemiraten',
        'F??renta staternas mindre ??ar i Oceanien och V??stindien' => 'F??renta staternas mindre ??ar i Oceanien och V??stindien ',
        'Gabon' => 'Gabon',
        'Gambia' => 'Gambia',
        'Georgien ' => 'Georgien',
        'Ghana' => 'Ghana',
        'Gibraltar' => 'Gibraltar',
        'Grekland ' => 'Grekland',
        'Grenada' => 'Grenada',
        'Gr??nland ' => 'Gr??nland',
        'Guadeloupe ' => 'Guadeloupe',
        'Guam' => 'Guam',
        'Guatemala' => 'Guatemala',
        'Guernsey ' => 'Guernsey',
        'Guinea' => 'Guinea',
        'Guinea-Bissau' => 'Guinea-Bissau',
        'Guyana' => 'Guyana',
        'Haiti' => 'Haiti',
        'Heard Island och McDonald Islands' => 'Heard Island och McDonald Islands',
        'Honduras ' => 'Honduras',
        'Hong kong' => 'Hong kong',
        'Indien' => 'Indien',
        'Indonesien ' => 'Indonesien',
        'Irak' => 'Irak',
        'Iran' => 'Iran',
        'Irland' => 'Irland',
        'Island' => 'Island',
        'Isle of Man' => 'Isle of Man',
        'Israel' => 'Israel',
        'Italien' => 'Italien',
        'Jamaica' => 'Jamaica',
        'Japan' => 'Japan',
        'Jersey' => 'Jersey',
        'Jordanien' => 'Jordanien',
        'Jul??n' => 'Jul??n',
        'Kambodja ' => 'Kambodja',
        'Kamerun' => 'Kamerun',
        'Kanada' => 'Kanada',
        'Kap Verde' => 'Kap Verde',
        'Kazakstan' => 'Kazakstan',
        'Kenya' => 'Kenya',
        'Kina' => 'Kina',
        'Kirgizistan' => 'Kirgizistan',
        'Kiribati ' => 'Kiribati',
        'Kokos??arna ' => 'Kokos??arna',
        'Komorerna' => 'Komorerna',
        'Kongo-Kinshasa' => 'Kongo-Kinshasa',
        'Kosovo' => 'Kosovo',
        'Kroatien ' => 'Kroatien',
        'Kuba' => 'Kuba',
        'Kurdistan' => 'Kurdistan',
        'Kuwait' => 'Kuwait',
        'Laos' => 'Laos',
        'Lesotho' => 'Lesotho',
        'Lettland ' => 'Lettland',
        'Libanon' => 'Libanon',
        'Liberia' => 'Liberia',
        'Libyen' => 'Libyen',
        'Liechtenstein' => 'Liechtenstein',
        'Litauen' => 'Litauen',
        'Luxemburg' => 'Luxemburg',
        'Macau' => 'Macau',
        'Madagaskar ' => 'Madagaskar',
        'Makedonien ' => 'Makedonien',
        'Malawi' => 'Malawi',
        'Malaysia ' => 'Malaysia',
        'Maldiverna ' => 'Maldiverna',
        'Mali' => 'Mali',
        'Malta' => 'Malta',
        'Marocco' => 'Marocco',
        'Marshall??arna' => 'Marshall??arna',
        'Martinique ' => 'Martinique',
        'Mauretanien' => 'Mauretanien',
        'Mauritius' => 'Mauritius',
        'Mayotte' => 'Mayotte',
        'Mexiko' => 'Mexiko',
        'Micronesia ' => 'Micronesia',
        'Moldavien' => 'Moldavien',
        'Monaco' => 'Monaco',
        'Mongoliet' => 'Mongoliet',
        'Montenegro ' => 'Montenegro',
        'Montserrat ' => 'Montserrat',
        'Mozambique ' => 'Mozambique',
        'Nagorno-Karabkh' => 'Nagorno-Karabkh',
        'Namibien ' => 'Namibien',
        'Nauru' => 'Nauru',
        'Nederl??nderna' => 'Nederl??nderna',
        'Nepal' => 'Nepal',
        'New Caledonia' => 'New Caledonia',
        'Nicaragua' => 'Nicaragua',
        'Niger' => 'Niger',
        'Nigeria' => 'Nigeria',
        'Niue' => 'Niue',
        'Nordirland ' => 'Nordirland',
        'Nordkorea' => 'Nordkorea',
        'Norfolk Island' => 'Norfolk Island',
        'Norge' => 'Norge',
        'Northern Mariana Islands ' => 'Northern Mariana Islands',
        'Nya Zeeland' => 'Nya Zeeland',
        'Oman' => 'Oman',
        'Pakistan ' => 'Pakistan',
        'Palau' => 'Palau',
        'Palestina' => 'Palestina',
        'Panama' => 'Panama',
        'Papua New Guinea ' => 'Papua New Guinea',
        'Paraguay ' => 'Paraguay',
        'Peru' => 'Peru',
        'Pitcairn Islands ' => 'Pitcairn Islands',
        'Polen' => 'Polen',
        'Portugal ' => 'Portugal',
        'Pridenestrovia' => 'Pridenestrovia',
        'Puerto Rico' => 'Puerto Rico',
        'Qatar' => 'Qatar',
        'Republiken kongo ' => 'Republiken kongo',
        'Rum??nien ' => 'Rum??nien',
        'Rwanda' => 'Rwanda',
        'Ryssland ' => 'Ryssland',
        'R??union' => 'R??union',
        'Saint Barth??lemy ' => 'Saint Barth??lemy',
        'Saint Kitts and Nevis' => 'Saint Kitts and Nevis',
        'Saint Lucia' => 'Saint Lucia',
        'Saint Martin' => 'Saint Martin',
        'Saint Pierre and Miquelon' => 'Saint Pierre and Miquelon',
        'Saint Vincent and the Grenadines ' => 'Saint Vincent and the Grenadines',
        'Samoa' => 'Samoa',
        'San Marino ' => 'San Marino',
        'Saudiarabien' => 'Saudiarabien',
        'Schweiz' => 'Schweiz',
        'Senegal' => 'Senegal',
        'Serbien' => 'Serbien',
        'Seychellerna' => 'Seychellerna',
        'Sierra Leone' => 'Sierra Leone',
        'Singapore' => 'Singapore',
        'Sint Maarten' => 'Sint Maarten',
        'Skottland' => 'Skottland',
        'Slovakien' => 'Slovakien',
        'Slovenia ' => 'Slovenia',
        'Solomon Islands' => 'Solomon Islands',
        'Somalien ' => 'Somalien',
        'South Georgia' => 'South Georgia',
        'South Ossetia' => 'South Ossetia',
        'Spanien' => 'Spanien',
        'Sri Lanka' => 'Sri Lanka',
        'Storbritannien' => 'Storbritannien',
        'Sudan' => 'Sudan',
        'Suriname ' => 'Suriname',
        'Svalbard och Jan Mayen' => 'Svalbard och Jan Mayen',
        'Swaziland' => 'Swaziland',
        'Sydafrika' => 'Sydafrika',
        'Sydkorea ' => 'Sydkorea',
        'Sydsudan ' => 'Sydsudan',
        'Syrien' => 'Syrien',
        'S??o Tom?? and Pr??ncipe' => 'S??o Tom?? and Pr??ncipe',
        'Taiwan' => 'Taiwan',
        'Tajikistan ' => 'Tajikistan',
        'Tanzania ' => 'Tanzania',
        'Tchad' => 'Tchad',
        'Thailand ' => 'Thailand',
        'Tibet' => 'Tibet',
        'Timor-Leste' => 'Timor-Leste',
        'Tjeckien ' => 'Tjeckien',
        'Togo' => 'Togo',
        'Tokelau' => 'Tokelau',
        'Tonga' => 'Tonga',
        'Trinidad och Tobago' => 'Trinidad och Tobago',
        'Tunisien ' => 'Tunisien',
        'Turkiet' => 'Turkiet',
        'Turkmenistan' => 'Turkmenistan',
        'Turks and Caicos Islands ' => 'Turks and Caicos Islands',
        'Tuvalu' => 'Tuvalu',
        'Tyskland ' => 'Tyskland',
        'USA' => 'USA',
        'Uganda' => 'Uganda',
        'Ukraina' => 'Ukraina',
        'Ungern' => 'Ungern',
        'Uruguay' => 'Uruguay',
        'Uzbekistan ' => 'Uzbekistan',
        'Vanuatu' => 'Vanuatu',
        'Vatikanstaten' => 'Vatikanstaten',
        'Venezuela' => 'Venezuela',
        'Vietnam' => 'Vietnam',
        'Vitryssland' => 'Vitryssland',
        'V??stsahara ' => 'V??stsahara',
        'Wales' => 'Wales',
        'Wallis och Futuna' => 'Wallis och Futuna',
        'Yemen' => 'Yemen',
        'Zambia' => 'Zambia',
        'Zimbabwe ' => 'Zimbabwe',
        '??land' => '??land',
        '??sterrike' => '??sterrike'
    ],
    'emailTypes' => [
        0 => 'V??lj typ av mail',
        1 => 'V??lkomstmail v??rd',
        2 => 'V??lkomstmail g??st',
        3 => 'Mail till v??rd vid matchning',
        4 => 'V??lj middagsdatum senare',
        5 => 'V??lkomstmail vid inaktiv period',
        6 => 'V??lkomstmail till v??rd som valt datum sj??lv',
        7 => 'Feedbackemail efter middag',
        8 => 'Followupmail 2 m??n efter middag'
    ],
    'emailTemplateStatics' => [
        'intro_greeting' => 'Hej %s,',
        'outtro_greeting' => 'Varma h??lsningar,',
        'sender_company' => 'Invitationsdepartementet'
    ],
    'emailTemplateDefaults' => [
        1 => [
            'id' => 1,
            'title' => 'Middagsdags!',
            'paragraph1' => 'Hoppas du m??r bra, vad roligt att du vill bjuda p?? middag!',
            'paragraph2' => 'Vi b??rjar nu leta efter ett middagss??llskap till dig och h??r av oss med mer information. Allt arbete sker p?? ideell basis s?? ha g??rna ??verseende om det dr??jer lite innan vi h??r av oss.',
            'paragraph3' => 'H??r g??rna av dig om du har fr??gor och stort tack f??r ditt engagemang!',
            'signature' => '
            <a href="http://www.invitationsdepartementet.se">Invitationsdepartementet</a> // <a href="http://www.unitedinvitations.se">United Invitations</a><br/>
            Verkar f??r nya middagss??llskap och minnesv??rda m??ltider.<br/>
            <a href="http://www.nytimes.com/2014/07/31/world/europe/in-sweden-dinners-melt-cultural-barriers.html?_r=0">New York Times</a> -
            <a href="http://www.stockholmdirekt.se/nyheter/middag-med-gott-samtal-pa-menyn/LdeneD!r3kA8yYFgz4Gzv3VjmhI0Q/">S??dermalmsnytt</a> -
            <a href="http://www.zeit.de/2014/53/weihnachten-wunder-fluechtlinge-fussball">Die ZEIT</a>
            '
        ],
        2 => [
            'id' => 2,
            'title' => 'Middagsdags!',
            'paragraph1' => 'Hoppas du m??r bra, vad roligt att du vill g?? bort p?? middag!',
            'paragraph2' => 'Vi b??rjar nu leta efter ett middagss??llskap till dig och h??r av oss med mer information. Allt arbete sker p?? ideell basis s?? ha g??rna ??verseende om det dr??jer lite innan vi h??r av oss.',
            'paragraph3' => 'H??r g??rna av dig om du har fr??gor och stort tack f??r ditt engagemang!',
            'signature' => '
            <a href="http://www.invitationsdepartementet.se">Invitationsdepartementet</a> // <a href="http://www.unitedinvitations.se">United Invitations</a><br/>
            Verkar f??r nya middagss??llskap och minnesv??rda m??ltider.<br/>
            <a href="http://www.nytimes.com/2014/07/31/world/europe/in-sweden-dinners-melt-cultural-barriers.html?_r=0">New York Times</a> -
            <a href="http://www.stockholmdirekt.se/nyheter/middag-med-gott-samtal-pa-menyn/LdeneD!r3kA8yYFgz4Gzv3VjmhI0Q/">S??dermalmsnytt</a> -
            <a href="http://www.zeit.de/2014/53/weihnachten-wunder-fluechtlinge-fussball">Die ZEIT</a>
            '
        ],
        3 => [
            'id' => 3,
            'title' => 'Nu har din middag f??tt en matchning!',
            'paragraph1' => 'Hoppas du m??r bra! P?? DATUM s?? kommer F??RNAMN EFTERNAMN fr??n LAND g??rna p?? middag hos er. F??RNAMN tar med sig en vuxen ( K??N ). F??RNAMN ??r allergisk mot/??ter inte: ALLERGIER OCH PREFERENSER. Hon l??ser svenska p?? SKOLA och har telefonnummer NNNNNNNNN.', // not used since dynamic stuff is inserted
            'paragraph2' => 'V??nligen skicka ett V??lkommen p?? middag-sms p?? svenska till %s med er adress, ev. kod, v??ning, namn p?? d??rren och n??rmsta h??llplats, samt tid och dag (som p??minnelse). Standardtid f??r middagar ??r 18.30. Om du f??redrar en annan tid skriver du det i sms:et. Det ??r viktigt att ni etablerar kontakt med varandra, om du inte f??r tag p?? din g??st - h??r av dig till oss.',
            'paragraph3' => 'M??ten mellan m??nniskor kan vara b??de enkelt och komplicerat. Du ??r alltid ??r v??lkommen att h??ra av dig till mig om ditt m??te av n??gon anledning inte blev som det var t??nkt. Det ??r viktig information f??r oss och v??r verksamhet och som vi g??rna vill f??lja upp. ??nskar er en trevlig kv??ll och l??t mig veta om du har n??gra fr??gor. Tack f??r att ni bjuder p?? middag!',
            'signature' => '
            <br/>
            P.S. Om ni ??nskar, dela g??rna en bild fr??n middagsbordet, med alla n??rvarandes samtycke, p?? facebooksidan eller instagram #invitationsdepartementet. Har du funnit en ny bekantskap ??r det bara att h??lla kontakten, om inte hoppas vi att ni ??iallafall fick en minnesv??rd m??ltid och du ??r varmt v??lkommen att bjuda p?? middag igen.<br/>
            <br/>
            <a href="http://www.invitationsdepartementet.se">Invitationsdepartementet</a> // <a href="http://www.unitedinvitations.se">United Invitations</a><br/>
            Verkar f??r nya middagss??llskap och minnesv??rda m??ltider.<br/>
            <a href="http://www.nytimes.com/2014/07/31/world/europe/in-sweden-dinners-melt-cultural-barriers.html?_r=0">New York Times</a> -
            <a href="http://www.stockholmdirekt.se/nyheter/middag-med-gott-samtal-pa-menyn/LdeneD!r3kA8yYFgz4Gzv3VjmhI0Q/">S??dermalmsnytt</a> -
            <a href="http://www.zeit.de/2014/53/weihnachten-wunder-fluechtlinge-fussball">Die ZEIT</a>
            '
        ],
        4 => [
            'id' => 4,
            'title' => 'N??r vill du ??ta middag?',
            'paragraph1' => 'Vad roligt att du vill bjuda p?? middag!',
            'paragraph2' => 'N??r du hittat ett datum som passar kan du boka in dig som middagsv??rd i v??r kalender <a href="%s">h??r</a>.',
            'paragraph3' => 'Har du n??gra fr??gor ??r det bara att h??ra av dig.',
            'signature' => '
            <a href="http://www.invitationsdepartementet.se">Invitationsdepartementet</a> // <a href="http://www.unitedinvitations.se">United Invitations</a><br/>
            Verkar f??r nya middagss??llskap och minnesv??rda m??ltider.<br/>
            <a href="http://www.nytimes.com/2014/07/31/world/europe/in-sweden-dinners-melt-cultural-barriers.html?_r=0">New York Times</a> -
            <a href="http://www.stockholmdirekt.se/nyheter/middag-med-gott-samtal-pa-menyn/LdeneD!r3kA8yYFgz4Gzv3VjmhI0Q/">S??dermalmsnytt</a> -
            <a href="http://www.zeit.de/2014/53/weihnachten-wunder-fluechtlinge-fussball">Die ZEIT</a>
            '
        ],
        5 => [
            'id' => 5,
            'title' => 'Tack f??r din anm??lan till Invitationsdepartementet!',
            'paragraph1' => 'Vad roligt att du vill bjuda p?? middag! Just nu har vi paus i verksamheten men vi kommer h??ra av oss till dig n??r vi ??r uppe och snurrar igen.',
            'paragraph2' => 'Har du n??gra fr??gor ??r det bara att h??ra av dig.',
            'signature' => '
            <a href="http://www.invitationsdepartementet.se">Invitationsdepartementet</a> // <a href="http://www.unitedinvitations.se">United Invitations</a><br/>
            Verkar f??r nya middagss??llskap och minnesv??rda m??ltider.<br/>
            <a href="http://www.nytimes.com/2014/07/31/world/europe/in-sweden-dinners-melt-cultural-barriers.html?_r=0">New York Times</a> -
            <a href="http://www.stockholmdirekt.se/nyheter/middag-med-gott-samtal-pa-menyn/LdeneD!r3kA8yYFgz4Gzv3VjmhI0Q/">S??dermalmsnytt</a> -
            <a href="http://www.zeit.de/2014/53/weihnachten-wunder-fluechtlinge-fussball">Die ZEIT</a>
            '
        ],
        6 =>
        [
            'id' => 6,
            'title' => 'Middagsdags!',
            'paragraph1' => 'Hoppas du m??r bra, vad roligt att du vill bjuda p?? middag!',
            'paragraph2' => 'Vi har bokat in en middag %s och ber att f?? ??terkomma med detaljer om ditt middagss??llskap. Namn, nationalitet, antal personer, eventuella allergier och telefonnummer f??r du senast 48h innan middagen.',
            'paragraph3' => 'H??r g??rna av dig om du har fr??gor och stort tack f??r ditt engagemang!',
            'signature' => '
            <a href="http://www.invitationsdepartementet.se">Invitationsdepartementet</a> // <a href="http://www.unitedinvitations.se">United Invitations</a><br/>
            Verkar f??r nya middagss??llskap och minnesv??rda m??ltider.<br/>
            <a href="http://www.nytimes.com/2014/07/31/world/europe/in-sweden-dinners-melt-cultural-barriers.html?_r=0">New York Times</a> -
            <a href="http://www.stockholmdirekt.se/nyheter/middag-med-gott-samtal-pa-menyn/LdeneD!r3kA8yYFgz4Gzv3VjmhI0Q/">S??dermalmsnytt</a> -
            <a href="http://www.zeit.de/2014/53/weihnachten-wunder-fluechtlinge-fussball">Die ZEIT</a>
            '
        ],
        7 =>
            [
                'id' => 7,
                'title' => 'Tack f??r senast',
                'paragraph1' => 'Hoppas att du m??r str??lande! Och att du hade en minnesv??rd middag med %s ig??r.',
                'paragraph2' => 'F??r att f?? b??ttre f??rst??else f??r er upplevelse och Invitationsdepartementets arbete skulle det vara gl??djande om du ville svara p?? <a href="%s">n??gra fr??gor h??r</a>. H??gt r??knat tar det en minut och det ??r enormt v??rdefullt f??r v??rt vidare arbete. ',
                'paragraph3' => 'Tack f??r att du ??r med och skapar ett v??nligare samh??lle. Stort tack f??r din tid. Du ??r toppen!',
                'signature' => '
            <a href="http://www.invitationsdepartementet.se">Invitationsdepartementet</a> // <a href="http://www.unitedinvitations.se">United Invitations</a><br/>
            Verkar f??r nya middagss??llskap och minnesv??rda m??ltider.<br/>
            <a href="http://www.nytimes.com/2014/07/31/world/europe/in-sweden-dinners-melt-cultural-barriers.html?_r=0">New York Times</a> -
            <a href="http://www.stockholmdirekt.se/nyheter/middag-med-gott-samtal-pa-menyn/LdeneD!r3kA8yYFgz4Gzv3VjmhI0Q/">S??dermalmsnytt</a> -
            <a href="http://www.zeit.de/2014/53/weihnachten-wunder-fluechtlinge-fussball">Die ZEIT</a>
            '
        ],
        8 =>
            [
                'id' => 8,
                'title' => 'Tack f??r senast',
                'paragraph1' => 'Hoppas att du m??r str??lande! Och att du hade en minnesv??rd middag med %s.',
                'paragraph2' => 'Nu har det g??tt ett tag sedan ni ??t middag och f??r att f?? b??ttre f??rst??else f??r er upplevelse och Invitationsdepartementets arbete skulle det vara gl??djande om du ville svara p?? <a href="%s">tv?? korta fr??gor h??r</a>. H??gt r??knat tar det en minut och det ??r enormt v??rdefullt f??r v??rt vidare arbete.',
                'paragraph3' => 'Tack f??r din hj??lp och anm??l dig g??rna igen f??r att g?? p?? middag igen. Du ??r toppen!',
                'signature' => '
            <a href="http://www.invitationsdepartementet.se">Invitationsdepartementet</a> // <a href="http://www.unitedinvitations.se">United Invitations</a><br/>
            Verkar f??r nya middagss??llskap och minnesv??rda m??ltider.<br/>
            <a href="http://www.nytimes.com/2014/07/31/world/europe/in-sweden-dinners-melt-cultural-barriers.html?_r=0">New York Times</a> -
            <a href="http://www.stockholmdirekt.se/nyheter/middag-med-gott-samtal-pa-menyn/LdeneD!r3kA8yYFgz4Gzv3VjmhI0Q/">S??dermalmsnytt</a> -
            <a href="http://www.zeit.de/2014/53/weihnachten-wunder-fluechtlinge-fussball">Die ZEIT</a>
            '
            ],
        9 =>
            [
                'id' => 9,
                'title' => 'Eng??ngsmiddagar ??r OK!',
                'paragraph1' => 'Hoppas att du m??r str??lande! Och att du hade en minnesv??rd middag med %s.',
                'paragraph2' => 'Nu har det g??tt ett tag sedan ni ??t middag med M??rten. En av v??ra vanligaste fr??gorna ??r om m??nniskor ses igen efter en middag, s?? vi skulle bli j??tteglad om du ville svara p?? <a href="%s">n??gra fr??gor</a>.',
                'paragraph3' => 'Middagen ske givetvis f??ruts??ttningsl??st, men det ??r v??rdefullt f??r oss att veta om djupare relationer uppst??r. Tack igen! Vi gillar dig!',
                'signature' => '
            <a href="http://www.invitationsdepartementet.se">Invitationsdepartementet</a> // <a href="http://www.unitedinvitations.se">United Invitations</a><br/>
            Verkar f??r nya middagss??llskap och minnesv??rda m??ltider.<br/>
            <a href="http://www.nytimes.com/2014/07/31/world/europe/in-sweden-dinners-melt-cultural-barriers.html?_r=0">New York Times</a> -
            <a href="http://www.stockholmdirekt.se/nyheter/middag-med-gott-samtal-pa-menyn/LdeneD!r3kA8yYFgz4Gzv3VjmhI0Q/">S??dermalmsnytt</a> -
            <a href="http://www.zeit.de/2014/53/weihnachten-wunder-fluechtlinge-fussball">Die ZEIT</a>
            '
            ],
    ],
    'defaultDateConstraintMessage' => "Just nu har verksamheten lite paus, men v??lkommen att registrera dig s?? h??r vi av oss n??r vi drar ig??ng igen!<br><br>V??nliga h??lsningar,<br>Invitationsdepartementet",
    'defaultConfirmationSignupMessage' => "Vi har skickat ett email med instruktioner, det b??r komma fram inom n??gra minuter."

];