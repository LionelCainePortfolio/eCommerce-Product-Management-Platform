  <h1>eCommerce Product Management Platform</h1>
  <h2>Overview</h2>
  <p>This project is an eCommerce product management platform designed for sellers operating in a dropshipping model. The platform provides automated scraping from AliExpress and Shopee, allowing users to efficiently manage product details, track links, and streamline their dropshipping workflow.
</p>
  <h2>Features</h2>
    <ul>
        <li><strong>Automated Scraping:</strong> Fetch product information from AliExpress and Shopee.</li>
        <li><strong>Product Management:</strong> Manage product details, including name, price, notes, shipping time, and location.</li>
        <li><strong>Link Tracking:</strong> Keep track of links associated with each product.</li>
        <li><strong>Dropshipping Support:</strong> Tailored for sellers in a dropshipping model.</li>
    </ul>
  <h2>Usage</h2>
    <h2>Usage</h2>
    <ol>
        <li><strong>Configuration:</strong> Create a <code>config.php</code> file and set up database details.</li>
        <li><strong>Pagination:</strong> Adjust pagination parameters in <code>getData.php</code>.</li>
        <li><strong>Product Display:</strong> Responsive card format with different styles indicating product status.</li>
        <li><strong>Integration with Marketplaces:</strong> Icons represent integrated marketplaces.</li>
        <li><strong>Product Actions:</strong> Add products to an import list and order samples.</li>
    </ol>
  <h2>How to Run</h2>
  <ol>
    <li>Clone the repository.</li>
    <li>Set up a MySQL database and configure it in <code>config.php</code>. </li>
        <code>
define("DB_SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "password");
 define("DB_NAME", "m1039_platform_demo");
        </code>
    <li>Import the database schema from the provided SQL file.</li>
    <li>Host the application on a PHP-enabled server.</li>
  </ol>
  <h2>Demo</h2> Visit: https://gpo-01-backup.usermd.net/platform_demo/
  
  Username: test Password: test
