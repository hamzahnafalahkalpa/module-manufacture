<?php

return [
    [
        "name" => "Bahan Baku",
        "note" => "Material mentah yang digunakan untuk produksi",
        "childs" => [
            ["name" => "Kayu", "note" => "Bahan kayu mentah untuk berbagai keperluan"],
            ["name" => "Logam", "note" => "Besi, aluminium, tembaga, stainless steel"],
            ["name" => "Plastik", "note" => "Polimer seperti PVC, ABS, HDPE, PET"],
            ["name" => "Kertas & Karton", "note" => "Bahan dasar kertas untuk kemasan atau cetak"],
            ["name" => "Serat & Tekstil", "note" => "Kapas, wol, poliester, nilon"],
            ["name" => "Batu & Mineral", "note" => "Marmer, granit, pasir silika"],
        ]
    ],
    [
        "name" => "Bahan Setengah Jadi",
        "note" => "Material yang telah diproses sebagian",
        "childs" => [
            ["name" => "Plat Besi", "note" => "Lembaran besi yang siap diproses"],
            ["name" => "Kawat Tembaga", "note" => "Digunakan untuk kebutuhan listrik"],
            ["name" => "Lembaran Plastik", "note" => "Material plastik untuk produksi"],
            ["name" => "Papan Kayu Olahan", "note" => "MDF, Plywood, Particle Board"],
            ["name" => "Besi Hollow", "note" => "Besi berbentuk kotak atau bulat"],
        ]
    ],
    [
        "name" => "Bahan Kimia",
        "note" => "Bahan kimia yang digunakan dalam berbagai industri",
        "childs" => [
            ["name" => "Reagen", "note" => "Bahan kimia untuk laboratorium"],
            ["name" => "Pelapis & Cat", "note" => "Cat tembok, cat kayu, epoxy"],
            ["name" => "Perekat & Adhesive", "note" => "Lem kayu, lem besi, lem epoxy"],
            ["name" => "Bahan Pembersih", "note" => "Alkohol, disinfektan, sabun industri"],
            ["name" => "Bahan Kimia Berbahaya", "note" => "Asam sulfat, amonia, zat korosif"],
        ]
    ],
    [
        "name" => "Material Medis & Farmasi",
        "note" => "Material untuk kebutuhan medis dan farmasi",
        "childs" => [
            ["name" => "Bahan Baku Obat", "note" => "Zat aktif dalam formulasi obat"],
            ["name" => "Eksipien", "note" => "Bahan tambahan dalam obat seperti gelatin, gula, pewarna"],
            ["name" => "Peralatan Medis", "note" => "Jarum suntik, alat tes, selang infus"],
            ["name" => "Bahan Sterilisasi", "note" => "Alkohol, formalin, autoclave pouch"],
            ["name" => "Kemasan Farmasi", "note" => "Botol, blister pack, ampul"],
            ["name" => "Reagen Laboratorium", "note" => "Zat kimia untuk diagnosis dan penelitian"],
        ]
    ],
    [
        "name" => "Material Konstruksi",
        "note" => "Material yang digunakan dalam proyek konstruksi",
        "childs" => [
            ["name" => "Beton & Campuran", "note" => "Beton siap pakai, semen, pasir"],
            ["name" => "Baja & Besi", "note" => "Baja tulangan, wiremesh, besi siku"],
            ["name" => "Kayu Bangunan", "note" => "Kayu untuk struktur dan finishing"],
            ["name" => "Material Isolasi", "note" => "Glasswool, styrofoam, peredam suara"],
            ["name" => "Kaca & Akrilik", "note" => "Kaca tempered, akrilik lembaran"],
            ["name" => "Cat & Finishing", "note" => "Cat interior, cat eksterior, plamir"],
        ]
    ],
    [
        "name" => "Material Elektronik",
        "note" => "Material yang digunakan dalam industri elektronik",
        "childs" => [
            ["name" => "Komponen Elektronik", "note" => "Resistor, kapasitor, transistor"],
            ["name" => "Kabel & Konektor", "note" => "Kabel listrik, serat optik, konektor RJ45"],
            ["name" => "Baterai & Power Supply", "note" => "Baterai lithium, UPS, solar panel"],
            ["name" => "Sensor & Modul", "note" => "Sensor suhu, sensor tekanan, microcontroller"],
            ["name" => "PCB & Sirkuit", "note" => "Papan PCB, microchip, IC"],
        ]
    ],
    [
        "name" => "Material Otomotif",
        "note" => "Material yang digunakan dalam industri kendaraan",
        "childs" => [
            ["name" => "Suku Cadang Mesin", "note" => "Piston, rantai, belt, bearing"],
            ["name" => "Pelumas & Fluida", "note" => "Oli mesin, coolant, rem hidrolik"],
            ["name" => "Bahan Bodi Kendaraan", "note" => "Fiberglass, plastik ABS, baja"],
            ["name" => "Ban & Karet", "note" => "Ban kendaraan, karet peredam"],
        ]
    ],
    [
        "name" => "Material Makanan & Minuman",
        "note" => "Bahan untuk produksi makanan dan minuman",
        "childs" => [
            ["name" => "Bahan Baku Makanan", "note" => "Gula, garam, tepung, minyak"],
            ["name" => "Bahan Tambahan Pangan", "note" => "Pengawet, perisa, pewarna makanan"],
            ["name" => "Kemasan Makanan", "note" => "Karton, plastik food grade"],
            ["name" => "Bahan Pembersih & Sanitasi", "note" => "Disinfektan food grade, sabun cuci alat"],
        ]
    ]
];
