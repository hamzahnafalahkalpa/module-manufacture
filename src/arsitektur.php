Product
├── hasMany: BOMs
│   └── BOM
│       ├── belongsTo: Product
│       ├── hasMany: BOMItems
│       │   └── BOMItem
│       │       ├── belongsTo: BOM
│       │       ├── belongsTo: Material
│       │       └── attributes: qty
│       └── attributes: name, version, is_default, etc
│
├── hasMany: Productions
│   └── Production
│       ├── belongsTo: Product
│       ├── hasOne: BOQ
│       │   └── BOQ
│       │       ├── belongsTo: Production
│       │       ├── hasMany: BOQItems
│       │       │   └── BOQItem
│       │       │       ├── belongsTo: BOQ
│       │       │       ├── belongsTo: Material
│       │       │       └── attributes: qty, price, total_price
│       │       └── attributes: version?, source_bom_id?, etc
│       ├── hasOne: ProductionReport (optional)
│       └── attributes: qty_produced, date, status, etc

Material
├── belongsTo: MaterialCategory
├── morphsTo: Item
└── hasMany: BOMItems / BOQItems

MaterialCategory
└── hasMany: Materials

Item (Generic Table)
├── morphsTo: (Product or Material or Others)
├── attributes: barcode, cogs, selling_price, stock
└── used for: tracking stock movement, price updates, etc

Procurement / Stock Flow (Optional)
└── affects: Item.cogs via mean calculation (based on qty & total cost)
