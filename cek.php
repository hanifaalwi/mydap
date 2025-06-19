<?php
if (is_writable("uploads")) {
    echo "✅ Folder uploads bisa ditulis.";
} else {
    echo "❌ Folder uploads TIDAK bisa ditulis.";
}
?>
