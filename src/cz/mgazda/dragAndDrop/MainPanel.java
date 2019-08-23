/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package cz.mgazda.dragAndDrop;

import java.awt.Color;
import java.awt.Graphics;
import java.awt.Graphics2D;
import java.awt.event.MouseEvent;
import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;
import javax.swing.JPanel;

/**
 *
 * @author Milan Gazda <gazda@soma-eng.cz>
 */
public class MainPanel extends JPanel {

    Rectangle activeRectangle;
    
    List<Rectangle> seznamObjektu;
    
    public MainPanel() {
        seznamObjektu = new ArrayList<Rectangle>();
        
        addMouseMotionListener(new java.awt.event.MouseAdapter(){
            @Override
            public void mouseDragged(MouseEvent e) {
                // pokud neni aktivni prvek, pokusim se jej najit
                if (activeRectangle == null) {
                    activeRectangle = findRectangle(e.getX(), e.getY());
                }

                // pokud je aktivni prvek, pokusim se s nim pohybovat
                if (activeRectangle != null) {
                    Graphics2D g = (Graphics2D) getGraphics();

                    g.setColor(g.getBackground());
                    g.draw(activeRectangle);
                    
                    g.setColor(Color.RED);
                    activeRectangle.setLocation(e.getX(), e.getY());
                    g.draw(activeRectangle);
                }
                
            }

            @Override
            public void mouseMoved(MouseEvent e) {
                //System.err.println(e.getX() + " : " + e.getY());
            }
        });
        
        addMouseListener(new java.awt.event.MouseAdapter(){
            /**
            * Invoked when the mouse button has been clicked (pressed
            * and released) on a component.
            */
            @Override
            public void mouseClicked(MouseEvent e) {
                
                if (e.getButton() == MouseEvent.BUTTON3) {
                    Graphics2D g = (Graphics2D) getGraphics();
                
                    Rectangle r = new Rectangle(e.getX(), e.getY(), 40, 40);

                    seznamObjektu.add(r);

                    g.draw(r);
                    //g.draw3DRect(e.getX(), e.getY(), 40, 40, true);
                }
                
            }

            /**
            * Invoked when a mouse button has been pressed on a component.
            */
            @Override
            public void mousePressed(MouseEvent e) {
                if (e.getButton() == MouseEvent.BUTTON1) {
                    activeRectangle = findRectangle(e.getX(), e.getY());
                    
                    if (activeRectangle != null) {
                        Graphics2D g = (Graphics2D) getGraphics();
                        
                        g.setColor(Color.red);
                        
                        g.draw(activeRectangle);
                    }
                }
            }

        });
    }
    
    @Override
    public void paintComponent(Graphics g) {
        super.paintComponent(g);
        
        Graphics2D g2d = (Graphics2D) g;
        
        for (Iterator<Rectangle> it = seznamObjektu.iterator(); it.hasNext();) {
            Rectangle r = it.next();
            
            g2d.draw(r);
        }
    }
    
    private Rectangle findRectangle(int x, int y) {
        for (Iterator<Rectangle> it = seznamObjektu.iterator(); it.hasNext();) {
            Rectangle r = it.next();
            
            if (r.contains(x, y)) {
                return r;
            }
        }
        
        return null;
    }
    
    

}
