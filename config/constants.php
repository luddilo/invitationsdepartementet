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
                3 => 'Inställd',
                4 => 'Värd meddelad om match'
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
                1 => 'Föreslagen',
                2 => 'Godkänd',
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
            '0' => 'Vill bli bättre'
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
            '2' => 'Gärna en familj',
            '1' => 'En gäst + eventuell sällskap',
            
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
            '1' => 'måndag',
            '2' => 'tisdag',
            '3' => 'onsdag',
            '4' => 'torsdag',
            '5' => 'fredag',
            '6' => 'lördag',
            '0' => 'söndag',
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
        'Amerikanska Jungfruöarna ' => 'Amerikanska Jungfruöarna',
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
        'Bouvetön ' => 'Bouvetön',
        'Brasilien' => 'Brasilien',
        'Brittiska Jungfruöarna' => 'Brittiska Jungfruöarna',
        'Brittiska territoriet i Indisk' => 'Brittiska territoriet i Indisk',
        'Brunei' => 'Brunei',
        'Bulgarien' => 'Bulgarien',
        'Burkina Faso' => 'Burkina Faso',
        'Burma' => 'Burma',
        'Burundi' => 'Burundi',
        'Caymanöarna' => 'Caymanöarna',
        'Centralafrikanska republiken' => 'Centralafrikanska republiken',
        'Chile' => 'Chile',
        'Colombia ' => 'Colombia',
        'Cooköarna' => 'Cooköarna',
        'Costa Rica ' => 'Costa Rica',
        'Curaçao' => 'Curaçao',
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
        'Falklandsöarna' => 'Falklandsöarna',
        'Fiji' => 'Fiji',
        'Filippinerna' => 'Filippinerna',
        'Finland' => 'Finland',
        'Frankrike' => 'Frankrike',
        'Franska Guyana' => 'Franska Guyana',
        'Franska Polynesien ' => 'Franska Polynesien',
        'Franska syd- och Antarktisterritorier' => 'Franska syd- och Antarktisterritorier ',
        'Färöarna ' => 'Färöarna',
        'Förenade Arabemiraten' => 'Förenade Arabemiraten',
        'Förenta staternas mindre öar i Oceanien och Västindien' => 'Förenta staternas mindre öar i Oceanien och Västindien ',
        'Gabon' => 'Gabon',
        'Gambia' => 'Gambia',
        'Georgien ' => 'Georgien',
        'Ghana' => 'Ghana',
        'Gibraltar' => 'Gibraltar',
        'Grekland ' => 'Grekland',
        'Grenada' => 'Grenada',
        'Grönland ' => 'Grönland',
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
        'Julön' => 'Julön',
        'Kambodja ' => 'Kambodja',
        'Kamerun' => 'Kamerun',
        'Kanada' => 'Kanada',
        'Kap Verde' => 'Kap Verde',
        'Kazakstan' => 'Kazakstan',
        'Kenya' => 'Kenya',
        'Kina' => 'Kina',
        'Kirgizistan' => 'Kirgizistan',
        'Kiribati ' => 'Kiribati',
        'Kokosöarna ' => 'Kokosöarna',
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
        'Marshallöarna' => 'Marshallöarna',
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
        'Nederländerna' => 'Nederländerna',
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
        'Rumänien ' => 'Rumänien',
        'Rwanda' => 'Rwanda',
        'Ryssland ' => 'Ryssland',
        'Réunion' => 'Réunion',
        'Saint Barthélemy ' => 'Saint Barthélemy',
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
        'São Tomé and Príncipe' => 'São Tomé and Príncipe',
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
        'Västsahara ' => 'Västsahara',
        'Wales' => 'Wales',
        'Wallis och Futuna' => 'Wallis och Futuna',
        'Yemen' => 'Yemen',
        'Zambia' => 'Zambia',
        'Zimbabwe ' => 'Zimbabwe',
        'Åland' => 'Åland',
        'Österrike' => 'Österrike'
    ],
    'emailTypes' => [
        0 => 'Välj typ av mail',
        1 => 'Välkomstmail värd',
        2 => 'Välkomstmail gäst',
        3 => 'Mail till värd vid matchning',
        4 => 'Välj middagsdatum senare',
        5 => 'Välkomstmail vid inaktiv period',
        6 => 'Välkomstmail till värd som valt datum själv',
        7 => 'Feedbackemail efter middag',
        8 => 'Followupmail 2 mån efter middag'
    ],
    'emailTemplateStatics' => [
        'intro_greeting' => 'Hej %s,',
        'outtro_greeting' => 'Varma hälsningar,',
        'sender_company' => 'Invitationsdepartementet'
    ],
    'emailTemplateDefaults' => [
        1 => [
            'id' => 1,
            'title' => 'Middagsdags!',
            'paragraph1' => 'Hoppas du mår bra, vad roligt att du vill bjuda på middag!',
            'paragraph2' => 'Vi börjar nu leta efter ett middagssällskap till dig och hör av oss med mer information. Allt arbete sker på ideell basis så ha gärna överseende om det dröjer lite innan vi hör av oss.',
            'paragraph3' => 'Hör gärna av dig om du har frågor och stort tack för ditt engagemang!',
            'signature' => '
            <a href="http://www.invitationsdepartementet.se">Invitationsdepartementet</a> // <a href="http://www.unitedinvitations.se">United Invitations</a><br/>
            Verkar för nya middagssällskap och minnesvärda måltider.<br/>
            <a href="http://www.nytimes.com/2014/07/31/world/europe/in-sweden-dinners-melt-cultural-barriers.html?_r=0">New York Times</a> -
            <a href="http://www.stockholmdirekt.se/nyheter/middag-med-gott-samtal-pa-menyn/LdeneD!r3kA8yYFgz4Gzv3VjmhI0Q/">Södermalmsnytt</a> -
            <a href="http://www.zeit.de/2014/53/weihnachten-wunder-fluechtlinge-fussball">Die ZEIT</a>
            '
        ],
        2 => [
            'id' => 2,
            'title' => 'Middagsdags!',
            'paragraph1' => 'Hoppas du mår bra, vad roligt att du vill gå bort på middag!',
            'paragraph2' => 'Vi börjar nu leta efter ett middagssällskap till dig och hör av oss med mer information. Allt arbete sker på ideell basis så ha gärna överseende om det dröjer lite innan vi hör av oss.',
            'paragraph3' => 'Hör gärna av dig om du har frågor och stort tack för ditt engagemang!',
            'signature' => '
            <a href="http://www.invitationsdepartementet.se">Invitationsdepartementet</a> // <a href="http://www.unitedinvitations.se">United Invitations</a><br/>
            Verkar för nya middagssällskap och minnesvärda måltider.<br/>
            <a href="http://www.nytimes.com/2014/07/31/world/europe/in-sweden-dinners-melt-cultural-barriers.html?_r=0">New York Times</a> -
            <a href="http://www.stockholmdirekt.se/nyheter/middag-med-gott-samtal-pa-menyn/LdeneD!r3kA8yYFgz4Gzv3VjmhI0Q/">Södermalmsnytt</a> -
            <a href="http://www.zeit.de/2014/53/weihnachten-wunder-fluechtlinge-fussball">Die ZEIT</a>
            '
        ],
        3 => [
            'id' => 3,
            'title' => 'Nu har din middag fått en matchning!',
            'paragraph1' => 'Hoppas du mår bra! På DATUM så kommer FÖRNAMN EFTERNAMN från LAND gärna på middag hos er. FÖRNAMN tar med sig en vuxen ( KÖN ). FÖRNAMN är allergisk mot/äter inte: ALLERGIER OCH PREFERENSER. Hon läser svenska på SKOLA och har telefonnummer NNNNNNNNN.', // not used since dynamic stuff is inserted
            'paragraph2' => 'Vänligen skicka ett Välkommen på middag-sms på svenska till %s med er adress, ev. kod, våning, namn på dörren och närmsta hållplats, samt tid och dag (som påminnelse). Standardtid för middagar är 18.30. Om du föredrar en annan tid skriver du det i sms:et. Det är viktigt att ni etablerar kontakt med varandra, om du inte får tag på din gäst - hör av dig till oss.',
            'paragraph3' => 'Möten mellan människor kan vara både enkelt och komplicerat. Du är alltid är välkommen att höra av dig till mig om ditt möte av någon anledning inte blev som det var tänkt. Det är viktig information för oss och vår verksamhet och som vi gärna vill följa upp. Önskar er en trevlig kväll och låt mig veta om du har några frågor. Tack för att ni bjuder på middag!',
            'signature' => '
            <br/>
            P.S. Om ni önskar, dela gärna en bild från middagsbordet, med alla närvarandes samtycke, på facebooksidan eller instagram #invitationsdepartementet. Har du funnit en ny bekantskap är det bara att hålla kontakten, om inte hoppas vi att ni  iallafall fick en minnesvärd måltid och du är varmt välkommen att bjuda på middag igen.<br/>
            <br/>
            <a href="http://www.invitationsdepartementet.se">Invitationsdepartementet</a> // <a href="http://www.unitedinvitations.se">United Invitations</a><br/>
            Verkar för nya middagssällskap och minnesvärda måltider.<br/>
            <a href="http://www.nytimes.com/2014/07/31/world/europe/in-sweden-dinners-melt-cultural-barriers.html?_r=0">New York Times</a> -
            <a href="http://www.stockholmdirekt.se/nyheter/middag-med-gott-samtal-pa-menyn/LdeneD!r3kA8yYFgz4Gzv3VjmhI0Q/">Södermalmsnytt</a> -
            <a href="http://www.zeit.de/2014/53/weihnachten-wunder-fluechtlinge-fussball">Die ZEIT</a>
            '
        ],
        4 => [
            'id' => 4,
            'title' => 'När vill du äta middag?',
            'paragraph1' => 'Vad roligt att du vill bjuda på middag!',
            'paragraph2' => 'När du hittat ett datum som passar kan du boka in dig som middagsvärd i vår kalender <a href="%s">här</a>.',
            'paragraph3' => 'Har du några frågor är det bara att höra av dig.',
            'signature' => '
            <a href="http://www.invitationsdepartementet.se">Invitationsdepartementet</a> // <a href="http://www.unitedinvitations.se">United Invitations</a><br/>
            Verkar för nya middagssällskap och minnesvärda måltider.<br/>
            <a href="http://www.nytimes.com/2014/07/31/world/europe/in-sweden-dinners-melt-cultural-barriers.html?_r=0">New York Times</a> -
            <a href="http://www.stockholmdirekt.se/nyheter/middag-med-gott-samtal-pa-menyn/LdeneD!r3kA8yYFgz4Gzv3VjmhI0Q/">Södermalmsnytt</a> -
            <a href="http://www.zeit.de/2014/53/weihnachten-wunder-fluechtlinge-fussball">Die ZEIT</a>
            '
        ],
        5 => [
            'id' => 5,
            'title' => 'Tack för din anmälan till Invitationsdepartementet!',
            'paragraph1' => 'Vad roligt att du vill bjuda på middag! Just nu har vi paus i verksamheten men vi kommer höra av oss till dig när vi är uppe och snurrar igen.',
            'paragraph2' => 'Har du några frågor är det bara att höra av dig.',
            'signature' => '
            <a href="http://www.invitationsdepartementet.se">Invitationsdepartementet</a> // <a href="http://www.unitedinvitations.se">United Invitations</a><br/>
            Verkar för nya middagssällskap och minnesvärda måltider.<br/>
            <a href="http://www.nytimes.com/2014/07/31/world/europe/in-sweden-dinners-melt-cultural-barriers.html?_r=0">New York Times</a> -
            <a href="http://www.stockholmdirekt.se/nyheter/middag-med-gott-samtal-pa-menyn/LdeneD!r3kA8yYFgz4Gzv3VjmhI0Q/">Södermalmsnytt</a> -
            <a href="http://www.zeit.de/2014/53/weihnachten-wunder-fluechtlinge-fussball">Die ZEIT</a>
            '
        ],
        6 =>
        [
            'id' => 6,
            'title' => 'Middagsdags!',
            'paragraph1' => 'Hoppas du mår bra, vad roligt att du vill bjuda på middag!',
            'paragraph2' => 'Vi har bokat in en middag %s och ber att få återkomma med detaljer om ditt middagssällskap. Namn, nationalitet, antal personer, eventuella allergier och telefonnummer får du senast 48h innan middagen.',
            'paragraph3' => 'Hör gärna av dig om du har frågor och stort tack för ditt engagemang!',
            'signature' => '
            <a href="http://www.invitationsdepartementet.se">Invitationsdepartementet</a> // <a href="http://www.unitedinvitations.se">United Invitations</a><br/>
            Verkar för nya middagssällskap och minnesvärda måltider.<br/>
            <a href="http://www.nytimes.com/2014/07/31/world/europe/in-sweden-dinners-melt-cultural-barriers.html?_r=0">New York Times</a> -
            <a href="http://www.stockholmdirekt.se/nyheter/middag-med-gott-samtal-pa-menyn/LdeneD!r3kA8yYFgz4Gzv3VjmhI0Q/">Södermalmsnytt</a> -
            <a href="http://www.zeit.de/2014/53/weihnachten-wunder-fluechtlinge-fussball">Die ZEIT</a>
            '
        ],
        7 =>
            [
                'id' => 7,
                'title' => 'Tack för senast',
                'paragraph1' => 'Hoppas att du mår strålande! Och att du hade en minnesvärd middag med %s igår.',
                'paragraph2' => 'För att få bättre förståelse för er upplevelse och Invitationsdepartementets arbete skulle det vara glädjande om du ville svara på <a href="%s">några frågor här</a>. Högt räknat tar det en minut och det är enormt värdefullt för vårt vidare arbete. ',
                'paragraph3' => 'Tack för att du är med och skapar ett vänligare samhälle. Stort tack för din tid. Du är toppen!',
                'signature' => '
            <a href="http://www.invitationsdepartementet.se">Invitationsdepartementet</a> // <a href="http://www.unitedinvitations.se">United Invitations</a><br/>
            Verkar för nya middagssällskap och minnesvärda måltider.<br/>
            <a href="http://www.nytimes.com/2014/07/31/world/europe/in-sweden-dinners-melt-cultural-barriers.html?_r=0">New York Times</a> -
            <a href="http://www.stockholmdirekt.se/nyheter/middag-med-gott-samtal-pa-menyn/LdeneD!r3kA8yYFgz4Gzv3VjmhI0Q/">Södermalmsnytt</a> -
            <a href="http://www.zeit.de/2014/53/weihnachten-wunder-fluechtlinge-fussball">Die ZEIT</a>
            '
        ],
        8 =>
            [
                'id' => 8,
                'title' => 'Tack för senast',
                'paragraph1' => 'Hoppas att du mår strålande! Och att du hade en minnesvärd middag med %s.',
                'paragraph2' => 'Nu har det gått ett tag sedan ni åt middag och för att få bättre förståelse för er upplevelse och Invitationsdepartementets arbete skulle det vara glädjande om du ville svara på <a href="%s">två korta frågor här</a>. Högt räknat tar det en minut och det är enormt värdefullt för vårt vidare arbete.',
                'paragraph3' => 'Tack för din hjälp och anmäl dig gärna igen för att gå på middag igen. Du är toppen!',
                'signature' => '
            <a href="http://www.invitationsdepartementet.se">Invitationsdepartementet</a> // <a href="http://www.unitedinvitations.se">United Invitations</a><br/>
            Verkar för nya middagssällskap och minnesvärda måltider.<br/>
            <a href="http://www.nytimes.com/2014/07/31/world/europe/in-sweden-dinners-melt-cultural-barriers.html?_r=0">New York Times</a> -
            <a href="http://www.stockholmdirekt.se/nyheter/middag-med-gott-samtal-pa-menyn/LdeneD!r3kA8yYFgz4Gzv3VjmhI0Q/">Södermalmsnytt</a> -
            <a href="http://www.zeit.de/2014/53/weihnachten-wunder-fluechtlinge-fussball">Die ZEIT</a>
            '
            ],
        9 =>
            [
                'id' => 9,
                'title' => 'Engångsmiddagar är OK!',
                'paragraph1' => 'Hoppas att du mår strålande! Och att du hade en minnesvärd middag med %s.',
                'paragraph2' => 'Nu har det gått ett tag sedan ni åt middag med Mårten. En av våra vanligaste frågorna är om människor ses igen efter en middag, så vi skulle bli jätteglad om du ville svara på <a href="%s">några frågor</a>.',
                'paragraph3' => 'Middagen ske givetvis förutsättningslöst, men det är värdefullt för oss att veta om djupare relationer uppstår. Tack igen! Vi gillar dig!',
                'signature' => '
            <a href="http://www.invitationsdepartementet.se">Invitationsdepartementet</a> // <a href="http://www.unitedinvitations.se">United Invitations</a><br/>
            Verkar för nya middagssällskap och minnesvärda måltider.<br/>
            <a href="http://www.nytimes.com/2014/07/31/world/europe/in-sweden-dinners-melt-cultural-barriers.html?_r=0">New York Times</a> -
            <a href="http://www.stockholmdirekt.se/nyheter/middag-med-gott-samtal-pa-menyn/LdeneD!r3kA8yYFgz4Gzv3VjmhI0Q/">Södermalmsnytt</a> -
            <a href="http://www.zeit.de/2014/53/weihnachten-wunder-fluechtlinge-fussball">Die ZEIT</a>
            '
            ],
    ],
    'defaultDateConstraintMessage' => "Just nu har verksamheten lite paus, men välkommen att registrera dig så hör vi av oss när vi drar igång igen!<br><br>Vänliga hälsningar,<br>Invitationsdepartementet",
    'defaultConfirmationSignupMessage' => "Vi har skickat ett email med instruktioner, det bör komma fram inom några minuter."

];