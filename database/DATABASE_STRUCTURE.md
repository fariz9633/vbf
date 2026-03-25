# VBF Database Structure & Relationships

## Database Entity Relationship Overview

### Core Authentication Flow
```
pwa_admin (Admin Users)
    ├── pwa_user_roles (Many-to-Many)
    │   └── pwa_roles
    └── pwa_user_capabilities

customers (Members/Users)
    ├── customerotp (OTP Verification)
    ├── pwa_chapter (Chapter Assignment)
    ├── pwa_category (Business Category)
    └── pwa_subcategory (Business Subcategory)
```

### Content Management Structure
```
Content Tables (Independent)
├── pwa_banner (Homepage Banners)
├── pwa_news (News Articles)
├── pwa_events (Events)
├── pwa_gallery (Image Gallery)
├── pwa_about (About Pages)
├── pwa_terms (Terms & Conditions)
├── pwa_scheme (Schemes/Programs)
├── pwa_activities (Activities)
├── pwa_media (Media Links)
└── pwa_content (General Content)
```

### Organization Hierarchy
```
pwa_department
    └── pwa_department_mem
            └── customers (Members)

pwa_chapter
    └── customers (Members by Chapter)

pwa_category
    └── pwa_subcategory
            └── customers (Members by Business Type)
```

### Meetings & Calendar System
```
pwa_meetings
    ├── pwa_meetings_mom (Minutes of Meeting)
    ├── pwa_meetings_attendance
    │   └── customers (Attendees)
    └── calender (Calendar Events)
```

### Opportunity Management
```
opportunity
    ├── customers (Opportunity Owner)
    ├── pwa_referencetype (How it came)
    ├── pwa_opportunitytype (Type of opportunity)
    ├── pwa_referalstatus (Current status)
    └── pwa_opportunityconnect (Connection method)
```

### Permissions & Access Control
```
pwa_modules
    └── pwa_submodules

pwa_admin
    ├── pwa_user_roles
    │   └── pwa_roles
    └── pwa_user_capabilities
            └── pwa_permissions
```

## Table Details

### 1. Authentication Tables

#### pwa_admin
- **Purpose**: Admin user accounts
- **Key Fields**: admin_id, name, email, password, phone, status
- **Relationships**: Links to pwa_user_roles, pwa_user_capabilities

#### customers
- **Purpose**: Customer/Member accounts
- **Key Fields**: id, reg_id, username, email, phone, chapter, category, subcategory
- **Relationships**: Links to chapters, categories, opportunities, meetings

#### customerotp
- **Purpose**: OTP verification for customer login
- **Key Fields**: id, phone, otp
- **Lifecycle**: Temporary storage for SMS OTP

### 2. Content Tables

#### pwa_banner
- **Purpose**: Homepage slider banners
- **Key Fields**: banner_id, title, descp, image, status

#### pwa_news
- **Purpose**: News articles and updates
- **Key Fields**: news_id, title, about, descp, image, status

#### pwa_events
- **Purpose**: Event management
- **Key Fields**: event_id, title, descp, date, time, location, status

#### pwa_gallery
- **Purpose**: Image gallery
- **Key Fields**: gallery_id, title, image, status

### 3. Organization Tables

#### pwa_department
- **Purpose**: Department/Committee structure
- **Key Fields**: id, name, status

#### pwa_department_mem
- **Purpose**: Department member assignments
- **Key Fields**: id, depid, memid (comma-separated customer IDs)
- **Note**: Uses text field for multiple member IDs

#### pwa_designation
- **Purpose**: Member designations/positions
- **Key Fields**: id, name, status

#### pwa_chapter
- **Purpose**: Geographic chapters
- **Key Fields**: id, name, status

#### pwa_category
- **Purpose**: Business categories
- **Key Fields**: id, name, image, status

#### pwa_subcategory
- **Purpose**: Business subcategories
- **Key Fields**: id, category_id, name, status
- **Relationship**: Belongs to pwa_category

### 4. Meetings Tables

#### pwa_meetings
- **Purpose**: Meeting management
- **Key Fields**: id, eid, title, date, time, location, prime_member, status
- **Special**: Stores meeting details and primary member info

#### pwa_meetings_mom
- **Purpose**: Minutes of Meeting
- **Key Fields**: id, mid (meeting id), title, descp
- **Relationship**: Belongs to pwa_meetings

#### pwa_meetings_attendance
- **Purpose**: Track meeting attendance
- **Key Fields**: id, mid (meeting id), custid (customer id)
- **Relationships**: Links meetings to customers

#### calender
- **Purpose**: Calendar events
- **Key Fields**: id, eid, name, color, start_time, status
- **Note**: Synced with meetings

### 5. Opportunity Tables

#### opportunity
- **Purpose**: Business opportunity tracking
- **Key Fields**: id, cust_id, name, descp, phone, referencetype, opportunitytype
- **Relationships**: Links to customers and lookup tables

#### pwa_referencetype
- **Purpose**: How opportunity was received
- **Examples**: Direct, Referral, Website, Social Media

#### pwa_opportunitytype
- **Purpose**: Type of opportunity
- **Examples**: Business, Partnership, Investment, Collaboration

#### pwa_referalstatus
- **Purpose**: Current status of opportunity
- **Examples**: New, In Progress, Completed, Closed

#### pwa_opportunityconnect
- **Purpose**: Connection method
- **Examples**: Email, Phone, Meeting, Event

### 6. Roles & Permissions

#### pwa_roles
- **Purpose**: User role definitions
- **Examples**: Super Admin, Admin, Manager, User

#### pwa_permissions
- **Purpose**: Permission definitions
- **Key Fields**: id, name, status

#### pwa_user_roles
- **Purpose**: Admin-to-Role mapping
- **Key Fields**: id, admin_id, roles_id
- **Type**: Many-to-Many relationship

#### pwa_user_capabilities
- **Purpose**: Admin capabilities
- **Key Fields**: id, admin_id, name (comma-separated)

#### pwa_modules
- **Purpose**: System modules
- **Examples**: Dashboard, Users, Customers, Meetings

#### pwa_submodules
- **Purpose**: Module sub-sections
- **Key Fields**: id, module_id, name, route

### 7. Support Tables

#### pwa_document
- **Purpose**: Document management
- **Key Fields**: id, title, file, status

#### pwa_support
- **Purpose**: Support tickets
- **Key Fields**: id, cust_id, subject, message, status

#### pwa_country & pwa_state
- **Purpose**: Location data
- **Relationship**: State belongs to Country

## Data Flow Examples

### User Registration Flow
1. Customer enters phone → `customerotp` (OTP sent)
2. OTP verified → Create record in `customers`
3. Profile completion → Update `customers` with chapter, category, etc.

### Meeting Creation Flow
1. Admin creates meeting → `pwa_meetings`
2. Calendar event created → `calender`
3. Members attend → `pwa_meetings_attendance`
4. MOM recorded → `pwa_meetings_mom`

### Opportunity Tracking Flow
1. Customer creates opportunity → `opportunity`
2. Links to reference type, opportunity type
3. Status updated → `pwa_referalstatus`
4. Connection method → `pwa_opportunityconnect`

## Indexes & Performance

### Recommended Indexes (Already in Schema)
- Primary keys on all tables (AUTO_INCREMENT)
- Unique indexes on email fields
- Foreign key relationships for lookups

### Additional Indexes (Consider Adding)
```sql
-- For faster customer lookups
CREATE INDEX idx_customers_phone ON customers(phone);
CREATE INDEX idx_customers_chapter ON customers(chapter);
CREATE INDEX idx_customers_category ON customers(category);

-- For meeting queries
CREATE INDEX idx_meetings_date ON pwa_meetings(date);
CREATE INDEX idx_meetings_status ON pwa_meetings(status);

-- For opportunity tracking
CREATE INDEX idx_opportunity_cust ON opportunity(cust_id);
CREATE INDEX idx_opportunity_status ON opportunity(referalstatus);
```

## Data Integrity Notes

1. **Soft Deletes**: Not implemented - uses status field (0/1)
2. **Timestamps**: All tables have created_at, updated_at
3. **Cascading**: Not enforced at DB level - handled in application
4. **Validation**: Handled by Laravel validation rules

## Backup Recommendations

- Daily backup of `customers` and `opportunity` tables
- Weekly full database backup
- Keep backups for at least 30 days
- Test restore procedures monthly

