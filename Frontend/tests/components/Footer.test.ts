// tests/components/Footer.test.ts
import { mount } from "@vue/test-utils";
import Footer from "@/layout/Footer.vue";
import { describe, it, expect } from "vitest";

describe("Footer.vue", () => {
  it("renders all sections correctly", () => {
    const wrapper = mount(Footer, {
      global: {
        stubs: ["router-link"]
      }
    });

    expect(wrapper.findAll(".footer-heading")[0].text()).toBe("Scriptum");
    expect(wrapper.find(".social-icons").exists()).toBe(true);
    expect(wrapper.findAll(".footer-heading")[1].text()).toBe("Gyors linkek");
    expect(wrapper.findAll(".footer-links li").length).toBe(2);
    expect(wrapper.findAll(".footer-heading")[2].text()).toBe("Kapcsolat");
    expect(wrapper.find("address").text()).toContain("Budapest");
    expect(wrapper.find("address").text()).toContain("Scriptum.Shop@gmail.com");
    expect(wrapper.find(".footer-bottom").text()).toContain("© 2025 Könyvesbolt - Minden jog fenntartva");
  });
  
  it("renders all social links", () => {
    const wrapper = mount(Footer, {
      global: {
        stubs: ["router-link"]
      }
    });
    
    const socialIcons = wrapper.findAll(".social-icon");
    expect(socialIcons.length).toBe(3);
    
    expect(socialIcons[0].find("i").classes()).toContain("fa-facebook-f");
    expect(socialIcons[1].find("i").classes()).toContain("fa-instagram");
    expect(socialIcons[2].find("i").classes()).toContain("fa-twitter");
  });
});