<?php includeStats([
    "isForNewBuilds" => true,
    "comment" =>
        'If you are going to use this in a new webpage, please review our <a href="table.php#sticky-header-example">Sticky Table Header Example</a> and decide which solution is better for your use-case.',
]); ?>
<?php includeStats([
    "isForNewBuilds" => false,
]); ?>
<?php includeStats(["isNPM" => true]); ?>

<p>
  If you have a lot of data in a table that you want to present to the user in small, bite-sized chunks, you may want to
  use a pagination UI element to do this. The solution presented below is accessible and works for keyboard and screen
  reader users.
</p>

<p>
  <strong>That said, it is a bit of work for a keyboard and screen reader use to any pagination UI, even if it is
    accessible.</strong> It may be easier for users to navigate <a href="table.php#sticky-header-example">a table with a
    sticky header
    instead</a>. Before you implement this solution (or if you are trying to make an existing pagination component
  accessible), weigh the pros and cons between this and the Sticky Header solution.
</p>

<h2 tabindex="-1">Paginated Table Example</h2>

<div class="enable-example" id="paginated-table-example">
  <div class="pagination">
    <div id="pagination-table-example__desc--top" class="sr-only">
      <p>
        The buttons inside this control allow you to paginate through
        the data in the table below, 10 columns at a time.
      </p>
    </div>
    <div class="pagination__pager" role="group" aria-labelledby="pagination-table-example__desc--top"></div>
    <figure>
      <figcaption id="pagination-table-example__caption" class="caption">
        Pagination Table Example: GDP of the World Nations
      </figcaption>
      <div class="sticky-table__container" tabindex="0">
        <table class="pagination__table" data-pagecount="7"
          data-pagination-alert-template="Now displaying rows ${n} through ${m}" data-pagination-button-spread="5"
          data-pagination-mobile-button-spread="4" aria-labelledby="pagination-table-example__caption">
          <thead>
            <tr>
              <th scope="col">Rank</th>
              <th scope="col">Name</th>
              <th scope="col">GDP (IMF '19)</th>
              <th scope="col">GDP (UN '16)</th>
              <th scope="col">GDP Per Capita</th>
              <th scope="col">Population</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>United States</td>
              <td>22.20 trillion</td>
              <td>18.62 trillion</td>
              <td>$66,678</td>
              <td>332,915,073</td>
            </tr>
            <tr>
              <td>2</td>
              <td>China</td>
              <td>15.47 trillion</td>
              <td>11.22 trillion</td>
              <td>$10,710</td>
              <td>1,444,216,107</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Japan</td>
              <td>5.50 trillion</td>
              <td>4.94 trillion</td>
              <td>$43,597</td>
              <td>126,050,804</td>
            </tr>
            <tr>
              <td>4</td>
              <td>Germany</td>
              <td>4.16 trillion</td>
              <td>3.48 trillion</td>
              <td>$49,548</td>
              <td>83,900,473</td>
            </tr>
            <tr>
              <td>5</td>
              <td>India</td>
              <td>3.26 trillion</td>
              <td>2.26 trillion</td>
              <td>$2,338</td>
              <td>1,393,409,038</td>
            </tr>
            <tr>
              <td>6</td>
              <td>United Kingdom</td>
              <td>2.93 trillion</td>
              <td>2.65 trillion</td>
              <td>$42,915</td>
              <td>68,207,116</td>
            </tr>
            <tr>
              <td>7</td>
              <td>France</td>
              <td>2.88 trillion</td>
              <td>2.47 trillion</td>
              <td>$43,959</td>
              <td>65,426,179</td>
            </tr>
            <tr>
              <td>8</td>
              <td>Italy</td>
              <td>2.09 trillion</td>
              <td>1.86 trillion</td>
              <td>$34,629</td>
              <td>60,367,477</td>
            </tr>
            <tr>
              <td>9</td>
              <td>Brazil</td>
              <td>2.06 trillion</td>
              <td>1.80 trillion</td>
              <td>$9,638</td>
              <td>213,993,437</td>
            </tr>
            <tr>
              <td>10</td>
              <td>Canada</td>
              <td>1.83 trillion</td>
              <td>1.53 trillion</td>
              <td>$48,137</td>
              <td>38,067,903</td>
            </tr>
            <tr>
              <td>11</td>
              <td>South Korea</td>
              <td>1.74 trillion</td>
              <td>1.41 trillion</td>
              <td>$34,000</td>
              <td>51,305,186</td>
            </tr>
            <tr>
              <td>12</td>
              <td>Russia</td>
              <td>1.67 trillion</td>
              <td>1.25 trillion</td>
              <td>$11,428</td>
              <td>145,912,025</td>
            </tr>
            <tr>
              <td>13</td>
              <td>Spain</td>
              <td>1.50 trillion</td>
              <td>1.24 trillion</td>
              <td>$32,026</td>
              <td>46,745,216</td>
            </tr>
            <tr>
              <td>14</td>
              <td>Australia</td>
              <td>1.48 trillion</td>
              <td>1.30 trillion</td>
              <td>$57,447</td>
              <td>25,788,215</td>
            </tr>
            <tr>
              <td>15</td>
              <td>Mexico</td>
              <td>1.30 trillion</td>
              <td>1.08 trillion</td>
              <td>$9,963</td>
              <td>130,262,216</td>
            </tr>
            <tr>
              <td>16</td>
              <td>Indonesia</td>
              <td>1.21 trillion</td>
              <td>932.26 billion</td>
              <td>$4,374</td>
              <td>276,361,783</td>
            </tr>
            <tr>
              <td>17</td>
              <td>Netherlands</td>
              <td>954.93 billion</td>
              <td>777.23 billion</td>
              <td>$55,606</td>
              <td>17,173,099</td>
            </tr>
            <tr>
              <td>18</td>
              <td>Turkey</td>
              <td>809.55 billion</td>
              <td>863.71 billion</td>
              <td>$9,519</td>
              <td>85,042,738</td>
            </tr>
            <tr>
              <td>19</td>
              <td>Saudi Arabia</td>
              <td>790.06 billion</td>
              <td>639.62 billion</td>
              <td>$22,356</td>
              <td>35,340,683</td>
            </tr>
            <tr>
              <td>20</td>
              <td>Switzerland</td>
              <td>740.70 billion</td>
              <td>668.85 billion</td>
              <td>$84,987</td>
              <td>8,715,494</td>
            </tr>
            <tr>
              <td>21</td>
              <td>Poland</td>
              <td>643.27 billion</td>
              <td>471.40 billion</td>
              <td>$17,019</td>
              <td>37,797,005</td>
            </tr>
            <tr>
              <td>22</td>
              <td>Taiwan</td>
              <td>633.70 billion</td>
              <td></td>
              <td>$26,564</td>
              <td>23,855,010</td>
            </tr>
            <tr>
              <td>23</td>
              <td>Sweden</td>
              <td>576.72 billion</td>
              <td>514.48 billion</td>
              <td>$56,763</td>
              <td>10,160,169</td>
            </tr>
            <tr>
              <td>24</td>
              <td>Belgium</td>
              <td>553.78 billion</td>
              <td>467.96 billion</td>
              <td>$47,607</td>
              <td>11,632,326</td>
            </tr>
            <tr>
              <td>25</td>
              <td>Thailand</td>
              <td>547.43 billion</td>
              <td>407.03 billion</td>
              <td>$7,826</td>
              <td>69,950,850</td>
            </tr>
            <tr>
              <td>26</td>
              <td>Argentina</td>
              <td>515.35 billion</td>
              <td>545.87 billion</td>
              <td>$11,300</td>
              <td>45,605,826</td>
            </tr>
            <tr>
              <td>27</td>
              <td>Nigeria</td>
              <td>496.12 billion</td>
              <td>404.65 billion</td>
              <td>$2,347</td>
              <td>211,400,708</td>
            </tr>
            <tr>
              <td>28</td>
              <td>Iran</td>
              <td>495.69 billion</td>
              <td>425.40 billion</td>
              <td>$5,830</td>
              <td>85,028,759</td>
            </tr>
            <tr>
              <td>29</td>
              <td>Austria</td>
              <td>481.68 billion</td>
              <td>390.80 billion</td>
              <td>$53,265</td>
              <td>9,043,070</td>
            </tr>
            <tr>
              <td>30</td>
              <td>United Arab Emirates</td>
              <td>449.13 billion</td>
              <td>348.74 billion</td>
              <td>$44,953</td>
              <td>9,991,089</td>
            </tr>
            <tr>
              <td>31</td>
              <td>Norway</td>
              <td>438.62 billion</td>
              <td>371.07 billion</td>
              <td>$80,251</td>
              <td>5,465,630</td>
            </tr>
            <tr>
              <td>32</td>
              <td>Ireland</td>
              <td>405.19 billion</td>
              <td>304.82 billion</td>
              <td>$81,315</td>
              <td>4,982,907</td>
            </tr>
            <tr>
              <td>33</td>
              <td>Israel</td>
              <td>403.96 billion</td>
              <td>317.75 billion</td>
              <td>$45,958</td>
              <td>8,789,774</td>
            </tr>
            <tr>
              <td>34</td>
              <td>Hong Kong</td>
              <td>402.03 billion</td>
              <td>320.91 billion</td>
              <td>$53,230</td>
              <td>7,552,810</td>
            </tr>
            <tr>
              <td>35</td>
              <td>Malaysia</td>
              <td>401.99 billion</td>
              <td>296.53 billion</td>
              <td>$12,265</td>
              <td>32,776,194</td>
            </tr>
            <tr>
              <td>36</td>
              <td>Singapore</td>
              <td>391.88 billion</td>
              <td>296.95 billion</td>
              <td>$66,457</td>
              <td>5,896,686</td>
            </tr>
            <tr>
              <td>37</td>
              <td>Philippines</td>
              <td>389.05 billion</td>
              <td>304.91 billion</td>
              <td>$3,503</td>
              <td>111,046,913</td>
            </tr>
            <tr>
              <td>38</td>
              <td>South Africa</td>
              <td>386.73 billion</td>
              <td>295.44 billion</td>
              <td>$6,441</td>
              <td>60,041,994</td>
            </tr>
            <tr>
              <td>39</td>
              <td>Denmark</td>
              <td>364.55 billion</td>
              <td>306.90 billion</td>
              <td>$62,709</td>
              <td>5,813,298</td>
            </tr>
            <tr>
              <td>40</td>
              <td>Colombia</td>
              <td>352.81 billion</td>
              <td>282.46 billion</td>
              <td>$6,882</td>
              <td>51,265,844</td>
            </tr>
            <tr>
              <td>41</td>
              <td>Bangladesh</td>
              <td>343.28 billion</td>
              <td>220.84 billion</td>
              <td>$2,064</td>
              <td>166,303,498</td>
            </tr>
            <tr>
              <td>42</td>
              <td>Egypt</td>
              <td>331.36 billion</td>
              <td>270.14 billion</td>
              <td>$3,178</td>
              <td>104,258,327</td>
            </tr>
            <tr>
              <td>43</td>
              <td>Chile</td>
              <td>313.56 billion</td>
              <td>247.05 billion</td>
              <td>$16,321</td>
              <td>19,212,361</td>
            </tr>
            <tr>
              <td>44</td>
              <td>Finland</td>
              <td>289.24 billion</td>
              <td>238.50 billion</td>
              <td>$52,131</td>
              <td>5,548,360</td>
            </tr>
            <tr>
              <td>45</td>
              <td>Vietnam</td>
              <td>282.37 billion</td>
              <td>205.28 billion</td>
              <td>$2,876</td>
              <td>98,168,833</td>
            </tr>
            <tr>
              <td>46</td>
              <td>Romania</td>
              <td>263.13 billion</td>
              <td>186.69 billion</td>
              <td>$13,757</td>
              <td>19,127,774</td>
            </tr>
            <tr>
              <td>47</td>
              <td>Czech Republic</td>
              <td>259.74 billion</td>
              <td>195.31 billion</td>
              <td>$24,219</td>
              <td>10,724,555</td>
            </tr>
            <tr>
              <td>48</td>
              <td>Portugal</td>
              <td>249.91 billion</td>
              <td>204.84 billion</td>
              <td>$24,578</td>
              <td>10,167,925</td>
            </tr>
            <tr>
              <td>49</td>
              <td>Iraq</td>
              <td>246.93 billion</td>
              <td>160.02 billion</td>
              <td>$5,997</td>
              <td>41,179,350</td>
            </tr>
            <tr>
              <td>50</td>
              <td>Peru</td>
              <td>244.16 billion</td>
              <td>192.21 billion</td>
              <td>$7,319</td>
              <td>33,359,418</td>
            </tr>
            <tr>
              <td>51</td>
              <td>Greece</td>
              <td>230.50 billion</td>
              <td>192.69 billion</td>
              <td>$22,226</td>
              <td>10,370,744</td>
            </tr>
            <tr>
              <td>52</td>
              <td>New Zealand</td>
              <td>224.94 billion</td>
              <td>187.52 billion</td>
              <td>$46,278</td>
              <td>4,860,643</td>
            </tr>
            <tr>
              <td>53</td>
              <td>Qatar</td>
              <td>204.01 billion</td>
              <td>152.45 billion</td>
              <td>$69,615</td>
              <td>2,930,528</td>
            </tr>
            <tr>
              <td>54</td>
              <td>Algeria</td>
              <td>193.06 billion</td>
              <td>159.05 billion</td>
              <td>$4,327</td>
              <td>44,616,624</td>
            </tr>
            <tr>
              <td>55</td>
              <td>Hungary</td>
              <td>177.73 billion</td>
              <td>125.82 billion</td>
              <td>$18,448</td>
              <td>9,634,164</td>
            </tr>
            <tr>
              <td>56</td>
              <td>Kazakhstan</td>
              <td>177.32 billion</td>
              <td>135.01 billion</td>
              <td>$9,335</td>
              <td>18,994,962</td>
            </tr>
            <tr>
              <td>57</td>
              <td>Ukraine</td>
              <td>147.17 billion</td>
              <td>93.27 billion</td>
              <td>$3,386</td>
              <td>43,466,819</td>
            </tr>
            <tr>
              <td>58</td>
              <td>Kuwait</td>
              <td>143.00 billion</td>
              <td>110.35 billion</td>
              <td>$33,036</td>
              <td>4,328,550</td>
            </tr>
            <tr>
              <td>59</td>
              <td>Morocco</td>
              <td>129.06 billion</td>
              <td>103.61 billion</td>
              <td>$3,456</td>
              <td>37,344,795</td>
            </tr>
            <tr>
              <td>60</td>
              <td>Slovakia</td>
              <td>117.40 billion</td>
              <td>89.77 billion</td>
              <td>$21,499</td>
              <td>5,460,721</td>
            </tr>
            <tr>
              <td>61</td>
              <td>Kenya</td>
              <td>109.12 billion</td>
              <td>70.53 billion</td>
              <td>$1,984</td>
              <td>54,985,698</td>
            </tr>
            <tr>
              <td>62</td>
              <td>Ecuador</td>
              <td>107.73 billion</td>
              <td>98.01 billion</td>
              <td>$6,022</td>
              <td>17,888,475</td>
            </tr>
            <tr>
              <td>63</td>
              <td>Puerto Rico</td>
              <td>104.12 billion</td>
              <td>105.03 billion</td>
              <td>$36,813</td>
              <td>2,828,255</td>
            </tr>
            <tr>
              <td>64</td>
              <td>Ethiopia</td>
              <td>99.37 billion</td>
              <td>70.31 billion</td>
              <td>$843</td>
              <td>117,876,227</td>
            </tr>
            <tr>
              <td>65</td>
              <td>Angola</td>
              <td>96.43 billion</td>
              <td>106.92 billion</td>
              <td>$2,842</td>
              <td>33,933,610</td>
            </tr>
            <tr>
              <td>66</td>
              <td>Dominican Republic</td>
              <td>90.46 billion</td>
              <td>71.58 billion</td>
              <td>$8,258</td>
              <td>10,953,703</td>
            </tr>
            <tr>
              <td>67</td>
              <td>Sri Lanka</td>
              <td>89.94 billion</td>
              <td>81.32 billion</td>
              <td>$4,184</td>
              <td>21,497,310</td>
            </tr>
            <tr>
              <td>68</td>
              <td>Guatemala</td>
              <td>87.63 billion</td>
              <td>68.76 billion</td>
              <td>$4,802</td>
              <td>18,249,860</td>
            </tr>
            <tr>
              <td>69</td>
              <td>Oman</td>
              <td>84.16 billion</td>
              <td>63.17 billion</td>
              <td>$16,112</td>
              <td>5,223,375</td>
            </tr>
            <tr>
              <td>70</td>
              <td>Panama</td>
              <td>75.49 billion</td>
              <td>55.19 billion</td>
              <td>$17,230</td>
              <td>4,381,579</td>
            </tr>
            <tr>
              <td>71</td>
              <td>Luxembourg</td>
              <td>73.69 billion</td>
              <td>58.63 billion</td>
              <td>$116,086</td>
              <td>634,814</td>
            </tr>
            <tr>
              <td>72</td>
              <td>Ghana</td>
              <td>72.26 billion</td>
              <td>42.79 billion</td>
              <td>$2,277</td>
              <td>31,732,129</td>
            </tr>
            <tr>
              <td>73</td>
              <td>Bulgaria</td>
              <td>71.75 billion</td>
              <td>53.24 billion</td>
              <td>$10,403</td>
              <td>6,896,663</td>
            </tr>
            <tr>
              <td>74</td>
              <td>Myanmar</td>
              <td>71.40 billion</td>
              <td>65.70 billion</td>
              <td>$1,303</td>
              <td>54,806,012</td>
            </tr>
            <tr>
              <td>75</td>
              <td>Venezuela</td>
              <td>70.11 billion</td>
              <td>291.38 billion</td>
              <td>$2,442</td>
              <td>28,704,954</td>
            </tr>
            <tr>
              <td>76</td>
              <td>Tanzania</td>
              <td>64.89 billion</td>
              <td></td>
              <td>$1,055</td>
              <td>61,498,437</td>
            </tr>
            <tr>
              <td>77</td>
              <td>Croatia</td>
              <td>64.59 billion</td>
              <td>51.23 billion</td>
              <td>$15,824</td>
              <td>4,081,651</td>
            </tr>
            <tr>
              <td>78</td>
              <td>Belarus</td>
              <td>63.66 billion</td>
              <td>47.41 billion</td>
              <td>$6,742</td>
              <td>9,442,862</td>
            </tr>
            <tr>
              <td>79</td>
              <td>Costa Rica</td>
              <td>63.46 billion</td>
              <td>57.44 billion</td>
              <td>$12,349</td>
              <td>5,139,052</td>
            </tr>
            <tr>
              <td>80</td>
              <td>Uruguay</td>
              <td>63.42 billion</td>
              <td>52.42 billion</td>
              <td>$18,197</td>
              <td>3,485,151</td>
            </tr>
            <tr>
              <td>81</td>
              <td>Macau</td>
              <td>62.16 billion</td>
              <td>45.31 billion</td>
              <td>$94,409</td>
              <td>658,394</td>
            </tr>
            <tr>
              <td>82</td>
              <td>Lebanon</td>
              <td>60.62 billion</td>
              <td>50.46 billion</td>
              <td>$8,955</td>
              <td>6,769,146</td>
            </tr>
            <tr>
              <td>83</td>
              <td>Slovenia</td>
              <td>58.21 billion</td>
              <td>44.71 billion</td>
              <td>$28,004</td>
              <td>2,078,724</td>
            </tr>
            <tr>
              <td>84</td>
              <td>Lithuania</td>
              <td>57.60 billion</td>
              <td>42.77 billion</td>
              <td>$21,414</td>
              <td>2,689,862</td>
            </tr>
            <tr>
              <td>85</td>
              <td>Turkmenistan</td>
              <td>57.06 billion</td>
              <td>36.18 billion</td>
              <td>$9,327</td>
              <td>6,117,924</td>
            </tr>
            <tr>
              <td>86</td>
              <td>Serbia</td>
              <td>56.89 billion</td>
              <td>38.30 billion</td>
              <td>$6,540</td>
              <td>8,697,550</td>
            </tr>
            <tr>
              <td>87</td>
              <td>Uzbekistan</td>
              <td>55.48 billion</td>
              <td>67.78 billion</td>
              <td>$1,635</td>
              <td>33,935,763</td>
            </tr>
            <tr>
              <td>88</td>
              <td>Dr Congo</td>
              <td>52.48 billion</td>
              <td>40.34 billion</td>
              <td>$568</td>
              <td>92,377,993</td>
            </tr>
            <tr>
              <td>89</td>
              <td>Libya</td>
              <td>50.42 billion</td>
              <td>42.96 billion</td>
              <td>$7,246</td>
              <td>6,958,532</td>
            </tr>
            <tr>
              <td>90</td>
              <td>Ivory Coast</td>
              <td>49.88 billion</td>
              <td>36.77 billion</td>
              <td>$1,844</td>
              <td>27,053,629</td>
            </tr>
            <tr>
              <td>91</td>
              <td>Azerbaijan</td>
              <td>47.43 billion</td>
              <td>37.85 billion</td>
              <td>$4,639</td>
              <td>10,223,342</td>
            </tr>
            <tr>
              <td>92</td>
              <td>Bolivia</td>
              <td>47.05 billion</td>
              <td>33.81 billion</td>
              <td>$3,976</td>
              <td>11,832,940</td>
            </tr>
            <tr>
              <td>93</td>
              <td>Jordan</td>
              <td>46.45 billion</td>
              <td>38.65 billion</td>
              <td>$4,523</td>
              <td>10,269,021</td>
            </tr>
            <tr>
              <td>94</td>
              <td>Paraguay</td>
              <td>45.38 billion</td>
              <td>27.17 billion</td>
              <td>$6,285</td>
              <td>7,219,638</td>
            </tr>
            <tr>
              <td>95</td>
              <td>Cameroon</td>
              <td>42.05 billion</td>
              <td>32.22 billion</td>
              <td>$1,544</td>
              <td>27,224,265</td>
            </tr>
            <tr>
              <td>96</td>
              <td>Bahrain</td>
              <td>40.71 billion</td>
              <td>32.18 billion</td>
              <td>$23,284</td>
              <td>1,748,296</td>
            </tr>
            <tr>
              <td>97</td>
              <td>Latvia</td>
              <td>38.10 billion</td>
              <td>27.57 billion</td>
              <td>$20,409</td>
              <td>1,866,942</td>
            </tr>
            <tr>
              <td>98</td>
              <td>Tunisia</td>
              <td>35.15 billion</td>
              <td>41.70 billion</td>
              <td>$2,945</td>
              <td>11,935,766</td>
            </tr>
            <tr>
              <td>99</td>
              <td>Uganda</td>
              <td>33.62 billion</td>
              <td>25.31 billion</td>
              <td>$713</td>
              <td>47,123,531</td>
            </tr>
            <tr>
              <td>100</td>
              <td>Estonia</td>
              <td>33.23 billion</td>
              <td>23.34 billion</td>
              <td>$25,080</td>
              <td>1,325,185</td>
            </tr>
            <tr>
              <td>101</td>
              <td>Nepal</td>
              <td>33.03 billion</td>
              <td>20.91 billion</td>
              <td>$1,113</td>
              <td>29,674,920</td>
            </tr>
            <tr>
              <td>102</td>
              <td>Yemen</td>
              <td>31.39 billion</td>
              <td>25.37 billion</td>
              <td>$1,029</td>
              <td>30,490,640</td>
            </tr>
            <tr>
              <td>103</td>
              <td>Cambodia</td>
              <td>29.31 billion</td>
              <td>20.02 billion</td>
              <td>$1,730</td>
              <td>16,946,438</td>
            </tr>
            <tr>
              <td>104</td>
              <td>El Salvador</td>
              <td>28.20 billion</td>
              <td>26.80 billion</td>
              <td>$4,326</td>
              <td>6,518,499</td>
            </tr>
            <tr>
              <td>105</td>
              <td>Senegal</td>
              <td>28.06 billion</td>
              <td>14.60 billion</td>
              <td>$1,632</td>
              <td>17,196,301</td>
            </tr>
            <tr>
              <td>106</td>
              <td>Iceland</td>
              <td>26.82 billion</td>
              <td>20.27 billion</td>
              <td>$78,115</td>
              <td>343,353</td>
            </tr>
            <tr>
              <td>107</td>
              <td>Cyprus</td>
              <td>26.35 billion</td>
              <td>20.05 billion</td>
              <td>$21,675</td>
              <td>1,215,584</td>
            </tr>
            <tr>
              <td>108</td>
              <td>Zimbabwe</td>
              <td>25.81 billion</td>
              <td>16.12 billion</td>
              <td>$1,710</td>
              <td>15,092,171</td>
            </tr>
            <tr>
              <td>109</td>
              <td>Honduras</td>
              <td>25.56 billion</td>
              <td>21.52 billion</td>
              <td>$2,540</td>
              <td>10,062,991</td>
            </tr>
            <tr>
              <td>110</td>
              <td>Zambia</td>
              <td>25.27 billion</td>
              <td>21.06 billion</td>
              <td>$1,336</td>
              <td>18,920,651</td>
            </tr>
            <tr>
              <td>111</td>
              <td>Trinidad And Tobago</td>
              <td>23.23 billion</td>
              <td>24.09 billion</td>
              <td>$16,557</td>
              <td>1,403,375</td>
            </tr>
            <tr>
              <td>112</td>
              <td>Papua New Guinea</td>
              <td>22.11 billion</td>
              <td>19.69 billion</td>
              <td>$2,425</td>
              <td>9,119,010</td>
            </tr>
            <tr>
              <td>113</td>
              <td>Laos</td>
              <td>22.01 billion</td>
              <td>15.81 billion</td>
              <td>$2,983</td>
              <td>7,379,358</td>
            </tr>
            <tr>
              <td>114</td>
              <td>Bosnia And Herzegovina</td>
              <td>21.34 billion</td>
              <td>16.91 billion</td>
              <td>$6,540</td>
              <td>3,263,466</td>
            </tr>
            <tr>
              <td>115</td>
              <td>Botswana</td>
              <td>20.87 billion</td>
              <td>15.57 billion</td>
              <td>$8,707</td>
              <td>2,397,241</td>
            </tr>
            <tr>
              <td>116</td>
              <td>Afghanistan</td>
              <td>20.68 billion</td>
              <td>20.24 billion</td>
              <td>$519</td>
              <td>39,835,428</td>
            </tr>
            <tr>
              <td>117</td>
              <td>Mali</td>
              <td>19.33 billion</td>
              <td>14.00 billion</td>
              <td>$927</td>
              <td>20,855,735</td>
            </tr>
            <tr>
              <td>118</td>
              <td>Georgia</td>
              <td>18.89 billion</td>
              <td>14.33 billion</td>
              <td>$4,746</td>
              <td>3,979,765</td>
            </tr>
            <tr>
              <td>119</td>
              <td>Gabon</td>
              <td>17.89 billion</td>
              <td>13.86 billion</td>
              <td>$7,852</td>
              <td>2,278,825</td>
            </tr>
            <tr>
              <td>120</td>
              <td>Albania</td>
              <td>17.21 billion</td>
              <td>11.86 billion</td>
              <td>$5,990</td>
              <td>2,872,933</td>
            </tr>
            <tr>
              <td>121</td>
              <td>Jamaica</td>
              <td>16.72 billion</td>
              <td>14.06 billion</td>
              <td>$5,622</td>
              <td>2,973,463</td>
            </tr>
            <tr>
              <td>122</td>
              <td>Malta</td>
              <td>16.34 billion</td>
              <td>11.00 billion</td>
              <td>$36,898</td>
              <td>442,784</td>
            </tr>
            <tr>
              <td>123</td>
              <td>Mozambique</td>
              <td>16.29 billion</td>
              <td>10.93 billion</td>
              <td>$507</td>
              <td>32,163,047</td>
            </tr>
            <tr>
              <td>124</td>
              <td>Burkina Faso</td>
              <td>16.27 billion</td>
              <td>11.70 billion</td>
              <td>$757</td>
              <td>21,497,096</td>
            </tr>
            <tr>
              <td>125</td>
              <td>Mauritius</td>
              <td>15.76 billion</td>
              <td>12.22 billion</td>
              <td>$12,374</td>
              <td>1,273,433</td>
            </tr>
            <tr>
              <td>126</td>
              <td>Mongolia</td>
              <td>14.96 billion</td>
              <td>11.16 billion</td>
              <td>$4,493</td>
              <td>3,329,289</td>
            </tr>
            <tr>
              <td>127</td>
              <td>Namibia</td>
              <td>14.63 billion</td>
              <td>10.95 billion</td>
              <td>$5,653</td>
              <td>2,587,344</td>
            </tr>
            <tr>
              <td>128</td>
              <td>Brunei</td>
              <td>14.28 billion</td>
              <td>11.40 billion</td>
              <td>$32,344</td>
              <td>441,532</td>
            </tr>
            <tr>
              <td>129</td>
              <td>Armenia</td>
              <td>13.87 billion</td>
              <td>10.57 billion</td>
              <td>$4,672</td>
              <td>2,968,127</td>
            </tr>
            <tr>
              <td>130</td>
              <td>Bahamas</td>
              <td>13.71 billion</td>
              <td>11.26 billion</td>
              <td>$34,542</td>
              <td>396,913</td>
            </tr>
            <tr>
              <td>131</td>
              <td>North Macedonia</td>
              <td>13.70 billion</td>
              <td>10.75 billion</td>
              <td>$6,578</td>
              <td>2,082,658</td>
            </tr>
            <tr>
              <td>132</td>
              <td>Guinea</td>
              <td>13.60 billion</td>
              <td>8.48 billion</td>
              <td>$1,008</td>
              <td>13,497,244</td>
            </tr>
            <tr>
              <td>133</td>
              <td>Madagascar</td>
              <td>13.54 billion</td>
              <td>11.22 billion</td>
              <td>$476</td>
              <td>28,427,328</td>
            </tr>
            <tr>
              <td>134</td>
              <td>Moldova</td>
              <td>12.79 billion</td>
              <td>6.77 billion</td>
              <td>$3,179</td>
              <td>4,024,019</td>
            </tr>
            <tr>
              <td>135</td>
              <td>Chad</td>
              <td>12.55 billion</td>
              <td>11.27 billion</td>
              <td>$742</td>
              <td>16,914,985</td>
            </tr>
            <tr>
              <td>136</td>
              <td>Nicaragua</td>
              <td>12.46 billion</td>
              <td>13.23 billion</td>
              <td>$1,859</td>
              <td>6,702,385</td>
            </tr>
            <tr>
              <td>137</td>
              <td>Equatorial Guinea</td>
              <td>12.26 billion</td>
              <td>10.68 billion</td>
              <td>$8,458</td>
              <td>1,449,896</td>
            </tr>
            <tr>
              <td>138</td>
              <td>Benin</td>
              <td>12.13 billion</td>
              <td>8.89 billion</td>
              <td>$974</td>
              <td>12,451,040</td>
            </tr>
            <tr>
              <td>139</td>
              <td>Republic Of The Congo</td>
              <td>11.37 billion</td>
              <td>7.78 billion</td>
              <td>$2,009</td>
              <td>5,657,013</td>
            </tr>
            <tr>
              <td>140</td>
              <td>Rwanda</td>
              <td>11.06 billion</td>
              <td>8.47 billion</td>
              <td>$833</td>
              <td>13,276,513</td>
            </tr>
            <tr>
              <td>141</td>
              <td>Niger</td>
              <td>10.63 billion</td>
              <td>7.53 billion</td>
              <td>$423</td>
              <td>25,130,817</td>
            </tr>
            <tr>
              <td>142</td>
              <td>Haiti</td>
              <td>9.65 billion</td>
              <td>7.65 billion</td>
              <td>$836</td>
              <td>11,541,685</td>
            </tr>
            <tr>
              <td>143</td>
              <td>Kyrgyzstan</td>
              <td>8.78 billion</td>
              <td>6.55 billion</td>
              <td>$1,325</td>
              <td>6,628,356</td>
            </tr>
            <tr>
              <td>144</td>
              <td>Somalia</td>
              <td>8.34 billion</td>
              <td>1.32 billion</td>
              <td>$510</td>
              <td>16,359,504</td>
            </tr>
            <tr>
              <td>145</td>
              <td>Eritrea</td>
              <td>8.12 billion</td>
              <td>5.41 billion</td>
              <td>$2,254</td>
              <td>3,601,467</td>
            </tr>
            <tr>
              <td>146</td>
              <td>Malawi</td>
              <td>7.86 billion</td>
              <td>5.32 billion</td>
              <td>$400</td>
              <td>19,647,684</td>
            </tr>
            <tr>
              <td>147</td>
              <td>Tajikistan</td>
              <td>7.84 billion</td>
              <td>6.95 billion</td>
              <td>$804</td>
              <td>9,749,627</td>
            </tr>
            <tr>
              <td>148</td>
              <td>Maldives</td>
              <td>6.21 billion</td>
              <td>4.22 billion</td>
              <td>$11,429</td>
              <td>543,617</td>
            </tr>
            <tr>
              <td>149</td>
              <td>Togo</td>
              <td>6.13 billion</td>
              <td>4.45 billion</td>
              <td>$723</td>
              <td>8,478,250</td>
            </tr>
            <tr>
              <td>150</td>
              <td>Montenegro</td>
              <td>5.74 billion</td>
              <td>4.37 billion</td>
              <td>$9,139</td>
              <td>628,053</td>
            </tr>
            <tr>
              <td>151</td>
              <td>Mauritania</td>
              <td>5.70 billion</td>
              <td>4.67 billion</td>
              <td>$1,193</td>
              <td>4,775,119</td>
            </tr>
            <tr>
              <td>152</td>
              <td>Fiji</td>
              <td>5.67 billion</td>
              <td>4.67 billion</td>
              <td>$6,281</td>
              <td>902,906</td>
            </tr>
            <tr>
              <td>153</td>
              <td>Barbados</td>
              <td>5.34 billion</td>
              <td>4.55 billion</td>
              <td>$18,557</td>
              <td>287,711</td>
            </tr>
            <tr>
              <td>154</td>
              <td>Eswatini</td>
              <td>4.81 billion</td>
              <td>4.01 billion</td>
              <td>$4,105</td>
              <td>1,172,362</td>
            </tr>
            <tr>
              <td>155</td>
              <td>Guyana</td>
              <td>4.61 billion</td>
              <td>3.44 billion</td>
              <td>$5,832</td>
              <td>790,326</td>
            </tr>
            <tr>
              <td>156</td>
              <td>Sierra Leone</td>
              <td>4.22 billion</td>
              <td>3.67 billion</td>
              <td>$518</td>
              <td>8,141,343</td>
            </tr>
            <tr>
              <td>157</td>
              <td>Suriname</td>
              <td>3.92 billion</td>
              <td>3.28 billion</td>
              <td>$6,622</td>
              <td>591,800</td>
            </tr>
            <tr>
              <td>158</td>
              <td>Burundi</td>
              <td>3.71 billion</td>
              <td>2.87 billion</td>
              <td>$303</td>
              <td>12,255,433</td>
            </tr>
            <tr>
              <td>159</td>
              <td>Timor Leste</td>
              <td>3.41 billion</td>
              <td>2.70 billion</td>
              <td>$2,540</td>
              <td>1,343,873</td>
            </tr>
            <tr>
              <td>160</td>
              <td>Liberia</td>
              <td>3.22 billion</td>
              <td>2.76 billion</td>
              <td>$621</td>
              <td>5,180,203</td>
            </tr>
            <tr>
              <td>161</td>
              <td>Aruba</td>
              <td>2.95 billion</td>
              <td>2.67 billion</td>
              <td>$27,536</td>
              <td>107,204</td>
            </tr>
            <tr>
              <td>162</td>
              <td>Bhutan</td>
              <td>2.94 billion</td>
              <td>2.21 billion</td>
              <td>$3,768</td>
              <td>779,898</td>
            </tr>
            <tr>
              <td>163</td>
              <td>Lesotho</td>
              <td>2.89 billion</td>
              <td>2.24 billion</td>
              <td>$1,339</td>
              <td>2,159,079</td>
            </tr>
            <tr>
              <td>164</td>
              <td>South Sudan</td>
              <td>2.80 billion</td>
              <td>6.53 billion</td>
              <td>$246</td>
              <td>11,381,378</td>
            </tr>
            <tr>
              <td>165</td>
              <td>Djibouti</td>
              <td>2.60 billion</td>
              <td>1.89 billion</td>
              <td>$2,593</td>
              <td>1,002,187</td>
            </tr>
            <tr>
              <td>166</td>
              <td>Central African Republic</td>
              <td>2.48 billion</td>
              <td>1.81 billion</td>
              <td>$505</td>
              <td>4,919,981</td>
            </tr>
            <tr>
              <td>167</td>
              <td>Cape Verde</td>
              <td>2.21 billion</td>
              <td>1.64 billion</td>
              <td>$3,930</td>
              <td>561,898</td>
            </tr>
            <tr>
              <td>168</td>
              <td>Belize</td>
              <td>2.07 billion</td>
              <td>1.74 billion</td>
              <td>$5,115</td>
              <td>404,914</td>
            </tr>
            <tr>
              <td>169</td>
              <td>Saint Lucia</td>
              <td>2.07 billion</td>
              <td>1.40 billion</td>
              <td>$11,220</td>
              <td>184,400</td>
            </tr>
            <tr>
              <td>170</td>
              <td>Gambia</td>
              <td>1.87 billion</td>
              <td>985.83 Mn</td>
              <td>$752</td>
              <td>2,486,945</td>
            </tr>
            <tr>
              <td>171</td>
              <td>Antigua And Barbuda</td>
              <td>1.81 billion</td>
              <td>1.46 billion</td>
              <td>$18,323</td>
              <td>98,731</td>
            </tr>
            <tr>
              <td>172</td>
              <td>Seychelles</td>
              <td>1.74 billion</td>
              <td>1.43 billion</td>
              <td>$17,582</td>
              <td>98,908</td>
            </tr>
            <tr>
              <td>173</td>
              <td>San Marino</td>
              <td>1.67 billion</td>
              <td>1.59 billion</td>
              <td>$49,152</td>
              <td>34,017</td>
            </tr>
            <tr>
              <td>174</td>
              <td>Guinea Bissau</td>
              <td>1.67 billion</td>
              <td>1.12 billion</td>
              <td>$828</td>
              <td>2,015,494</td>
            </tr>
            <tr>
              <td>175</td>
              <td>Solomon Islands</td>
              <td>1.61 billion</td>
              <td>1.13 billion</td>
              <td>$2,283</td>
              <td>703,996</td>
            </tr>
            <tr>
              <td>176</td>
              <td>Grenada</td>
              <td>1.33 billion</td>
              <td>1.02 billion</td>
              <td>$11,768</td>
              <td>113,021</td>
            </tr>
            <tr>
              <td>177</td>
              <td>Saint Kitts And Nevis</td>
              <td>1.12 billion</td>
              <td>909.85 Mn</td>
              <td>$20,880</td>
              <td>53,544</td>
            </tr>
            <tr>
              <td>178</td>
              <td>Vanuatu</td>
              <td>994.00 Mn</td>
              <td>837.52 Mn</td>
              <td>$3,161</td>
              <td>314,464</td>
            </tr>
            <tr>
              <td>179</td>
              <td>Samoa</td>
              <td>960.00 Mn</td>
              <td>822.23 Mn</td>
              <td>$4,796</td>
              <td>200,149</td>
            </tr>
            <tr>
              <td>180</td>
              <td>Saint Vincent And The Grenadines</td>
              <td>903.00 Mn</td>
              <td>765.32 Mn</td>
              <td>$8,116</td>
              <td>111,263</td>
            </tr>
            <tr>
              <td>181</td>
              <td>Comoros</td>
              <td>773.00 Mn</td>
              <td>1.15 billion</td>
              <td>$870</td>
              <td>888,451</td>
            </tr>
            <tr>
              <td>182</td>
              <td>Dominica</td>
              <td>590.00 Mn</td>
              <td>581.48 Mn</td>
              <td>$8,175</td>
              <td>72,167</td>
            </tr>
            <tr>
              <td>183</td>
              <td>Sao Tome And Principe</td>
              <td>527.00 Mn</td>
              <td>342.78 Mn</td>
              <td>$2,359</td>
              <td>223,368</td>
            </tr>
            <tr>
              <td>184</td>
              <td>Tonga</td>
              <td>512.00 Mn</td>
              <td>401.46 Mn</td>
              <td>$4,796</td>
              <td>106,760</td>
            </tr>
            <tr>
              <td>185</td>
              <td>Micronesia</td>
              <td>389.00 Mn</td>
              <td>329.90 Mn</td>
              <td>$3,346</td>
              <td>116,254</td>
            </tr>
            <tr>
              <td>186</td>
              <td>Palau</td>
              <td>324.00 Mn</td>
              <td>310.25 Mn</td>
              <td>$17,833</td>
              <td>18,169</td>
            </tr>
            <tr>
              <td>187</td>
              <td>Marshall Islands</td>
              <td>228.00 Mn</td>
              <td>183.00 Mn</td>
              <td>$3,825</td>
              <td>59,610</td>
            </tr>
            <tr>
              <td>188</td>
              <td>Kiribati</td>
              <td>196.00 Mn</td>
              <td>173.66 Mn</td>
              <td>$1,615</td>
              <td>121,392</td>
            </tr>
            <tr>
              <td>189</td>
              <td>Nauru</td>
              <td>117.00 Mn</td>
              <td>103.47 Mn</td>
              <td>$10,758</td>
              <td>10,876</td>
            </tr>
            <tr>
              <td>190</td>
              <td>Tuvalu</td>
              <td>53.00 Mn</td>
              <td>36.70 Mn</td>
              <td>$4,442</td>
              <td>11,931</td>
            </tr>
            <tr>
              <td>191</td>
              <td>Andorra</td>
              <td></td>
              <td>2.86 billion</td>
              <td>$36,952</td>
              <td>77,355</td>
            </tr>
            <tr>
              <td>192</td>
              <td>Bermuda</td>
              <td></td>
              <td>6.13 billion</td>
              <td>$98,685</td>
              <td>62,090</td>
            </tr>
            <tr>
              <td>193</td>
              <td>British Virgin Islands</td>
              <td></td>
              <td>971.24 Mn</td>
              <td>$31,927</td>
              <td>30,421</td>
            </tr>
            <tr>
              <td>194</td>
              <td>Cayman Islands</td>
              <td></td>
              <td>3.84 billion</td>
              <td>$57,808</td>
              <td>66,497</td>
            </tr>
            <tr>
              <td>195</td>
              <td>Cook Islands</td>
              <td></td>
              <td>290.19 Mn</td>
              <td>$16,521</td>
              <td>17,565</td>
            </tr>
            <tr>
              <td>196</td>
              <td>Cuba</td>
              <td></td>
              <td>89.69 billion</td>
              <td>$7,925</td>
              <td>11,317,505</td>
            </tr>
            <tr>
              <td>197</td>
              <td>French Polynesia</td>
              <td></td>
              <td>5.42 billion</td>
              <td>$19,176</td>
              <td>282,530</td>
            </tr>
            <tr>
              <td>198</td>
              <td>Palestine</td>
              <td></td>
              <td>13.40 billion</td>
              <td>$2,565</td>
              <td>5,222,748</td>
            </tr>
            <tr>
              <td>199</td>
              <td>Greenland</td>
              <td></td>
              <td>2.28 billion</td>
              <td>$40,138</td>
              <td>56,877</td>
            </tr>
            <tr>
              <td>200</td>
              <td>North Korea</td>
              <td></td>
              <td>16.79 billion</td>
              <td>$649</td>
              <td>25,887,041</td>
            </tr>
            <tr>
              <td>201</td>
              <td>Liechtenstein</td>
              <td></td>
              <td>6.19 billion</td>
              <td>$161,926</td>
              <td>38,250</td>
            </tr>
            <tr>
              <td>202</td>
              <td>Monaco</td>
              <td></td>
              <td>6.47 billion</td>
              <td>$163,701</td>
              <td>39,511</td>
            </tr>
            <tr>
              <td>203</td>
              <td>Montserrat</td>
              <td></td>
              <td>62.05 Mn</td>
              <td>$12,468</td>
              <td>4,977</td>
            </tr>
            <tr>
              <td>204</td>
              <td>Curacao</td>
              <td></td>
              <td>3.12 billion</td>
              <td>$18,941</td>
              <td>164,798</td>
            </tr>
            <tr>
              <td>205</td>
              <td>Sint Maarten</td>
              <td></td>
              <td>1.07 billion</td>
              <td>$24,695</td>
              <td>43,412</td>
            </tr>
            <tr>
              <td>206</td>
              <td>New Caledonia</td>
              <td></td>
              <td>9.45 billion</td>
              <td>$32,773</td>
              <td>288,218</td>
            </tr>
            <tr>
              <td>207</td>
              <td>Pakistan</td>
              <td></td>
              <td>282.51 billion</td>
              <td>$1,254</td>
              <td>225,199,937</td>
            </tr>
            <tr>
              <td>208</td>
              <td>Anguilla</td>
              <td></td>
              <td>337.52 Mn</td>
              <td>$22,327</td>
              <td>15,117</td>
            </tr>
            <tr>
              <td>209</td>
              <td>Sudan</td>
              <td></td>
              <td>82.89 billion</td>
              <td>$1,846</td>
              <td>44,909,353</td>
            </tr>
            <tr>
              <td>210</td>
              <td>Syria</td>
              <td></td>
              <td>22.16 billion</td>
              <td>$1,213</td>
              <td>18,275,702</td>
            </tr>
            <tr>
              <td>211</td>
              <td>Turks And Caicos Islands</td>
              <td></td>
              <td>917.55 Mn</td>
              <td>$23,388</td>
              <td>39,231</td>
            </tr>
          </tbody>
        </table>
      </div>
    </figure>

    <div class="pagination__alert sr-only" role="alert" aria-live="polite"></div>

    <div id="pagination-table-example__desc--bottom" class="sr-only">
      <p>
        The buttons inside this control allow you to paginate through
        the data in the table above, 10 columns at a time.
      </p>
    </div>
    <div class="pagination__pager" role="group" aria-labelledby="pagination-table-example__desc--bottom"></div>

    <template id="pagination__template--button">
      <button class="pagination__pager-item ${isSelectedClass}" data-index="${index}"
        aria-label="Display page ${label} of ${totalPages}" aria-current="${ariaCurrent}">
        ${label}
      </button>
    </template>

    <template id="pagination__template--previous-button">
      <button class="pagination__pager-item pagination__pager-item--previous" ${disabledattr}
        aria-label="Display previous page" data-index=${index}>
        &lt;
      </button>
    </template>

    <template id="pagination__template--next-button">
      <button class="pagination__pager-item pagination__pager-item--next" ${disabledattr} aria-label="Display next page"
        data-index=${index}>
        &gt;
      </button>
    </template>
  </div>
</div>

<?php includeShowcode("paginated-table-example"); ?>

<script type="application/json" id="paginated-table-example-props">
{
  "replaceHtmlRules": {
    "table": "<!-- Insert table data here -->"
  },
  "steps": [{
      "label": "Use the template HTML instead of hardcoding HTML inside your script",
      "highlight": "%OPENCLOSECONTENTTAG%template",
      "notes": "Hardcoding HTML in scripts is bad for two reasons: It prevents a developer for customizing the controls, and it can also hardcode the human language to a specific language.  In this example, we use the <code>template</code> HTML tag to create the HTML fragments for the script.  The dynamic content is added using template string style variable syntax(e.g. ${x}).  See the next step to see how this is replaced"
    },
    {
      "label": "Use <code>interpolate()</code> to place dynamic content inside the templates.",
      "highlight": "%JS%paginationTables.renderTable ||| interpolate",
      "notes": "The <a href=\"js/shared/interpolate.js\">interpolate function</a> is one that I created.  It is based on code from a Stack Overflow page, <a href=\"https://stackoverflow.com/questions/29182244/convert-a-string-to-a-template-string\">Convert a string to a template string</a>, with a few <a href=\"https://gomakethings.com/how-to-sanitize-third-party-content-with-vanilla-js-to-prevent-cross-site-scripting-xss-attacks/\">XSS sanitizing logic included</a>"
    },
    {
      "label": "Mark up the pagination widget correctly",
      "highlight": "role=\"group\" ||| aria-labelledby=\"pagination-table-example__desc--top\" ||| id=\"pagination-table-example__desc--top\" ||| aria-labelledby=\"pagination-table-example__desc--bottom\" ||| id=\"pagination-table-example__desc--bottom\"",
      "notes": "This widget is marked up as a group so screen readers will announce instructions on how it works when they navigate inside of it.  Note the instructions are screen reader only using the <a href=\"screen-reader-only-text.php\"><code>sr-only</code></a> class."
    },
    {
      "label": "Ensure all pagination buttons have an aria-label",
      "highlight": "aria-label=\"[^\"]*\"",
      "notes": "This is to ensure the purpose of every button is reported to screen readers, since words like  \"Greater than\", \"one\", \"two\", etc., would be confusing"
    },
    {
      "label": "Disable buttons that are not useful to screen reader users",
      "highlight": "\\$\\{disabledattr\\}",
      "notes": "This variable will be set to <code>\"disabled\"</code> if the arrow is supposed to be disabled, and to a blank string if not.  This element will be skipped in the tabbing order."
    },
    {
      "label": "Use an ARIA live region to give update information to screen reader users",
      "highlight": "aria-live ||| role=\"alert\"",
      "notes": "This aria-live region will be updated with information for screen reader users on what has changed in the table when the pagination buttons are pressed."
    }

  ]
}
</script>

<?= includeNPMInstructions(
    "paginate",
    [],
    "pagination",
    false,
    [],
    ".pagination__table",
) ?>

