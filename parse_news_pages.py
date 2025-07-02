import os
import re
from bs4 import BeautifulSoup

NEWS_DIR = "news_pages"
SQL_FILE = "sql/install_news.sql"


def _load_existing_ids():
    ids = set()
    pattern = re.compile(r"VALUES \((\d+),")
    with open(SQL_FILE, "r", encoding="utf-8") as handle:
        for line in handle:
            m = pattern.search(line)
            if m:
                ids.add(m.group(1))
    return ids


def _parse_file(path):
    """Return (title, author, date, body) or None if invalid."""
    with open(path, encoding="ISO-8859-1") as handle:
        data = handle.read()
    if "<!DOCTYPE" not in data or "That news item could not be found" in data:
        return None
    soup = BeautifulSoup(data, "html.parser")

    narrow = soup.find("div", class_="narrower")
    if narrow and narrow.find("h3"):
        p = narrow.find("p")
        if not p:
            return None
        h3 = p.find("h3")
        if not h3:
            return None
        title = h3.get_text(strip=True)
        span = h3.find_next_sibling("span")
        author = ""
        date = ""
        if span:
            txt = span.get_text(" ", strip=True)
            parts = [t.strip() for t in txt.split("·")]
            if parts:
                date = parts[0]
            if len(parts) > 1:
                author = parts[1]
            span.extract()
        h3.extract()
        body = p.get_text(separator=" ", strip=True)
    else:
        h1 = soup.find("h1")
        if not h1:
            return None
        title = h1.get_text(strip=True)
        h2 = h1.find_next("h2")
        author = ""
        date = ""
        if h2:
            txt = h2.get_text(" ", strip=True)
            if " - " in txt:
                date, author = [x.strip() for x in txt.split(" - ", 1)]
            else:
                date = txt.strip()
            h2.extract()
        p = h1.find_next("p")
        if not p:
            return None
        body = p.get_text(separator=" ", strip=True)
        h1.extract()

    return title, author, date, body


def _esc(text: str) -> str:
    return text.replace("'", "''").replace("\n", "\\n")


def main():
    existing = _load_existing_ids()
    entries = []

    for fname in sorted(os.listdir(NEWS_DIR)):
        if not fname.startswith("news_") or not fname.endswith(".php"):
            continue
        news_id = fname[5:-4]
        if news_id in existing:
            continue
        result = _parse_file(os.path.join(NEWS_DIR, fname))
        if not result:
            continue
        title, author, date, body = result
        entries.append(
            f"INSERT INTO news(id,title,author,publish_date,content) VALUES ({news_id},'{_esc(title)}','{_esc(author)}','{_esc(date)}','{_esc(body)}');"
        )

    if entries:
        with open(SQL_FILE, "a", encoding="utf-8") as handle:
            for line in entries:
                handle.write(line + "\n")
        print(f"Appended {len(entries)} records.")
    else:
        print("No new articles found.")


if __name__ == "__main__":
    main()
