<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA Tree Role Example</title>
		<?php include("includes/common-head-tags.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/treeLinks.css" />
    <meta charset="utf-8" >
</head>

<body>

    <?php include("includes/example-header.php"); ?>

    

    <main>
        <h1>ARIA Tree Role Example</h1>

            <aside class="notes">
                <h2>Notes:</h2>

                <ul>
                    <li>
                        This example was taken from the W3C's <a href="https://www.w3.org/TR/2017/NOTE-wai-aria-practices-1.1-20171214/examples/treeview/treeview-2/treeview-2a.html">Navigation Treeview Example Using Computed Properties</a>
                    </li>
                    <li>Voiceover will report a tree component as a table when tabbing into it.  It seems like strange behaviour, but
                        it is known and assumed to be expected behavior for Voiceover users according to <a href="http://accessibleculture.org/">Accessible Culture</a>'s article
                        <a href="http://accessibleculture.org/articles/2013/02/not-so-simple-aria-tree-views-and-screen-readers/#flora">(Not so) Simple ARIA Tree Views and Screen Readers</a>
                    </li>
                </ul>
    
            </aside>

            <h3 id="tree1">
                    Foods
                  </h3>
                  <ul role="tree" aria-labelledby="tree1">
                    <li role="treeitem" aria-expanded="false">
                      <span>
                        Fruits
                      </span>
                      <ul>
                        <li role="none">
                          <a role="treeitem" href="https://en.wikipedia.org/wiki/Orange_%28fruit%29">
                            
                                      Oranges
                                  
                          </a>
                        </li>
                        <li role="none">
                          <a role="treeitem" href="https://en.wikipedia.org/wiki/Pineapple">
                            
                                      Pineapple
                                  
                          </a>
                        </li>
                        <li role="treeitem" aria-expanded="false">
                          <span>
                            Apples
                          </span>
                          <ul role="group">
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/McIntosh_%28apple%29">
                                
                                          Macintosh
                                      
                              </a>
                            </li>
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Granny_Smith">
                                
                                          Granny Smith
                                      
                              </a>
                            </li>
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Fuji_(apple)">
                                
                                          Fuji
                                      
                              </a>
                            </li>
                          </ul>
                        </li>
                        <li role="none">
                          <a role="treeitem" href="https://en.wikipedia.org/wiki/Banana">
                            
                                      Bananas
                                  
                          </a>
                        </li>
                        <li role="treeitem" aria-expanded="false">
                          <span>
                             Pears 
                          </span>
                          <ul role="group">
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/D%27Anjou">
                                
                                          Anjou
                                      
                              </a>
                            </li>
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Williams_pear">
                                
                                          Bartlett
                                      
                              </a>
                            </li>
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Bosc_pear">
                                
                                          Bosc
                                      
                              </a>
                            </li>
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Pyrus_communis">
                                
                                          Concorde
                                      
                              </a>
                            </li>
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Pyrus_communis">
                                
                                          Seckel
                                      
                              </a>
                            </li>
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Pyrus_communis">
                                
                                          Starkrimson
                                      
                              </a>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li role="treeitem" aria-expanded="false">
                      <span>
                        Vegetables
                      </span>
                      <ul role="group">
                        <li role="treeitem" aria-expanded="false">
                          <span>
                            Podded Vegetables
                          </span>
                          <ul role="group">
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Lentil">
                                
                                            Lentil
                                        
                              </a>
                            </li>
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Pea">
                                
                                            Pea
                                        
                              </a>
                            </li>
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Peanut">
                                
                                            Peanut
                                        
                              </a>
                            </li>
                          </ul>
                        </li>
                        <li role="treeitem" aria-expanded="false">
                          <span>
                            Bulb and Stem Vegetables
                          </span>
                          <ul role="group">
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Asparagus">
                                
                                          Asparagus
                                      
                              </a>
                            </li>
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Celery">
                                
                                            Celery
                                        
                              </a>
                            </li>
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Leek">
                                
                                            Leek
                                        
                              </a>
                            </li>
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Onion">
                                
                                            Onion
                                        
                              </a>
                            </li>
                          </ul>
                        </li>
                        <li role="treeitem" aria-expanded="false">
                          <span>
                            Root and Tuberous Vegetables
                          </span>
                          <ul role="group">
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Carrot">
                                
                                            Carrot
                                        
                              </a>
                            </li>
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Ginger">
                                
                                            Ginger
                                        
                              </a>
                            </li>
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Parsnip">
                                
                                          Parsnip
                                      
                              </a>
                            </li>
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Potato">
                                
                                          Potato
                                      
                              </a>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li role="treeitem" aria-expanded="false">
                      <span>
                        Grains
                      </span>
                      <ul role="group">
                        <li role="treeitem" aria-expanded="false">
                          <span>
                            Cereal Grains
                          </span>
                          <ul role="group">
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Barley">
                                
                                          Barley
                                      
                              </a>
                            </li>
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Oats">
                                
                                          Oats
                                      
                              </a>
                            </li>
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Rice">
                                
                                          Rice
                                      
                              </a>
                            </li>
                          </ul>
                        </li>
                        <li role="treeitem" aria-expanded="false">
                          <span>
                            Pseudocereal Grains
                          </span>
                          <ul role="group">
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Amaranth">
                                
                                          Amaranth
                                      
                              </a>
                            </li>
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Buckwheat">
                                
                                          Bucketwheat
                                      
                              </a>
                            </li>
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Salvia_hispanica">
                                
                                          Chia
                                      
                              </a>
                            </li>
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Quinoa">
                                
                                          Quinoa
                                      
                              </a>
                            </li>
                          </ul>
                        </li>
                        <li role="treeitem" aria-expanded="false">
                          <span>
                            Oilseeds
                          </span>
                          <ul role="group">
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Brassica_juncea">
                                
                                          India Mustard
                                      
                              </a>
                            </li>
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Safflower">
                                
                                          Safflower
                                      
                              </a>
                            </li>
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Flax_seed">
                                
                                          Flax Seed
                                      
                              </a>
                            </li>
                            <li role="none">
                              <a role="treeitem" href="https://en.wikipedia.org/wiki/Poppy_seed">
                                
                                          Poppy Seed
                                      
                              </a>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                  </ul>

    </main>
    
    
    <script src="js/shared/treeLinks.js"></script>
    <script src="js/shared/treeItemLinks.js"></script>
</body>

</html>