# VBulletin to phpBB Forum Import Scripts

This collection of Python scripts extracts forum data from archived VBulletin pages and converts it to phpBB-compatible SQL format.

## Quick Start

### Prerequisites
```bash
pip install -r requirements.txt
```

### Run Complete Import
```bash
python run_full_import.py ../forums/ ./import_package
```

This will create a complete import package with all SQL files, avatars, and documentation.

## Individual Scripts

### 1. vbulletin_parser.py
Main parser that extracts:
- Forums and categories
- User accounts
- Threads/topics
- Posts and replies

**Usage:**
```bash
python vbulletin_parser.py <forums_directory> [output_file]
python vbulletin_parser.py ../forums/ forum_import.sql
```

### 2. memberlist_parser.py
Extracts enhanced user data from memberlist pages:
- Detailed user profiles
- Registration dates
- Post counts
- Location information

**Usage:**
```bash
python memberlist_parser.py <forums_directory> [output_file]
python memberlist_parser.py ../forums/ memberlist_import.sql
```

### 3. avatar_signature_parser.py
Processes user avatars:
- Copies avatar files to phpBB format
- Generates avatar assignment SQL
- Creates migration script

**Usage:**
```bash
python avatar_signature_parser.py <forums_directory> [avatar_dir] [sql_file]
python avatar_signature_parser.py ../forums/ ./avatars avatar_updates.sql
```

### 4. run_full_import.py
Orchestrates all scripts to create complete import package:
- Runs all parsers in sequence
- Creates organized output directory
- Generates installation guide

**Usage:**
```bash
python run_full_import.py <forums_directory> [output_directory]
python run_full_import.py ../forums/ ./complete_import
```

## Input File Types

The scripts process these VBulletin file types:

- **forumid_*.php** - Forum category listings
- **thread_*.php** - Thread pages with posts
- **memberlist_*.php** - User directory pages
- **avatar_*.gif/jpg/png** - User avatar images
- **post_*.php** - Individual post pages (if available)

## Output Structure

Complete import package contains:

```
import_package/
├── forum_import.sql          # Main forum data
├── memberlist_import.sql     # Enhanced user data
├── avatar_updates.sql        # Avatar assignments
├── avatars/                  # Avatar image files
│   ├── 123_avatar_123.gif
│   ├── migrate_avatars.sh    # Migration helper
│   └── ...
└── IMPORT_GUIDE.txt         # Installation instructions
```

## phpBB Import Process

1. **Install phpBB** - Set up fresh phpBB 3.x installation
2. **Run Import Scripts** - Generate SQL and avatar files
3. **Import SQL** - Execute SQL files in phpBB database
4. **Copy Avatars** - Move avatar files to phpBB directory
5. **Post-Import Tasks** - Rebuild search index, update statistics

See `IMPORT_GUIDE.txt` in generated package for detailed instructions.

## Data Extracted

### Forums
- Forum ID and name
- Forum descriptions
- Category hierarchy
- Post/topic counts

### Users
- User ID and username
- Registration dates
- Post counts
- Location information
- Avatar assignments
- User signatures (basic)

### Topics/Threads
- Thread ID and title
- Forum assignment
- Original poster
- Creation timestamp
- Post count

### Posts
- Post ID and content
- Thread assignment
- Author information
- Post timestamp
- Subject/title
- IP logging status

## Limitations

- **Passwords**: Users need to reset passwords (VB hashes incompatible)
- **Attachments**: File attachments not included
- **Private Messages**: PMs not extracted
- **Advanced BBCode**: Some VB-specific formatting may need cleanup
- **Permissions**: User groups/permissions need manual setup
- **HTML Content**: Some posts may need manual cleanup

## Troubleshooting

### Common Issues

1. **Encoding Errors**: Ensure files are UTF-8 encoded
2. **Missing Dependencies**: Install BeautifulSoup4 and lxml
3. **Large Files**: Process may be slow for large forums
4. **Malformed HTML**: Some archived pages may have parsing issues

### Error Handling

Scripts include error handling for:
- Malformed HTML pages
- Missing file references
- Invalid timestamps
- Encoding issues

Errors are logged to console with file context.

### Performance

For large forums (1000+ threads):
- Process may take 30+ minutes
- Consider running in chunks
- Monitor memory usage
- Use SSD for better I/O performance

## Customization

Scripts can be modified for:
- Different VBulletin versions
- Custom field extraction
- Alternative output formats
- Specific data filtering

See inline comments in Python files for customization points.

## Example Usage

```bash
# Install dependencies
pip install beautifulsoup4 lxml

# Process archived Steam forums
python run_full_import.py /path/to/steam/forums ./steam_import

# Manual processing
python vbulletin_parser.py ./forums forum_data.sql
python memberlist_parser.py ./forums users_data.sql
python avatar_signature_parser.py ./forums ./avatars avatar_data.sql
```

## Support

- Check Python error output for specific issues
- Validate HTML structure of source files
- Review phpBB documentation for import requirements
- Test on small subset before full import

For phpBB-specific import issues, consult phpBB community support.